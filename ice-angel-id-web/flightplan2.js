// used by aliyun cn server

var plan = require('flightplan');

var newRelease = new Date().getTime();

var config = {
  deployTo: '/home/iceangel/apps/webapp',
  keepReleases: 5,
  newReleasePath: '/home/iceangel/apps/webapp/releases/' + newRelease,
  currentReleasePath: '/home/iceangel/apps/webapp/current',
  tmpDir: '/home/iceangel/tmp/iceangel_web/'
};

// aliyun cn server
plan.target('production', {
  host: '120.25.125.240',
  username: 'iceangel',
  password: '1CEaliyun',
  agent: process.env.SSH_AUTH_SOCK
});

plan.local('deploy', localTasks);

plan.remote('deploy', remoteTasks);

plan.remote('rollback', rollbackTasks);

function localTasks(local) {
  local.log('Run build');
  local.exec('./node_modules/gulp/bin/gulp.js release:web');

  local.log('Archive the build');
  local.exec('tar cvzf build.tar.gz -C dist .');

  local.log('Copy archive to remote hosts');
  local.transfer('build.tar.gz', config.tmpDir);

  local.log('Delete build archive');
  local.rm('build.tar.gz');
}

function remoteTasks(remote) {
  remote.log('Setup the new release folder');
  remote.exec('mkdir -p ' + config.newReleasePath);

  remote.log('Move files to the new release folder');
  remote.exec([
    'cd ' + config.tmpDir,
    'tar xvzf build.tar.gz -C ' + config.newReleasePath,
    'rm build.tar.gz'
  ].join(' && '));

  remote.log('Link current to the new release');
  remote.exec([
    'ln -snf ',
    config.newReleasePath,
    config.currentReleasePath
  ].join(' '));

  deleteOldReleases(remote);
}

function rollbackTasks(remote) {
  remote.log('Attempt to rollback to previous release');
  var remoteReleases = getRemoteReleases(remote);

  switch (remoteReleases.length) {
    case 0:
      remote.log('There is nothing to rollback');
      break;

    case 1:
      remote.log('Cannot rollback, you have only one release');
      break;

    default:
      var current = remoteReleases.pop();
      var previous = remoteReleases.pop();

      remote.log('Link current to the previous release');
      remote.exec([
        'ln -snf ',
        config.deployTo + '/releases/' + previous,
        config.currentReleasePath
      ].join(' '));

      remote.log('Delete the current release');
      remote.rm('-rf ' + config.deployTo + '/releases/' + current);

      break;
  }
}

function deleteOldReleases(remote) {
  var remoteReleases = getRemoteReleases(remote);
  var toBeRemoved = [];

  if (remoteReleases.length > config.keepReleases) {

    remote.log('Remove old releases');
    toBeRemoved = remoteReleases.slice(0, remoteReleases.length - config.keepReleases);
    toBeRemoved = toBeRemoved.map(function (release) {
      return config.deployTo + '/releases/' + release;
    });

    remote.rm('-rf ' + toBeRemoved.join(' '));
  }
}

function getRemoteReleases(remote) {
  var releases = [];
  remote.log('List production releases');
  var remoteReleases = remote.ls(config.deployTo + '/releases', {silent: true, failsafe: true});

  if ((remoteReleases.code === 0) && (remoteReleases.stdout !== null)) {
    releases = remoteReleases.stdout.trim().split('\n');
  }

  return releases;
}

