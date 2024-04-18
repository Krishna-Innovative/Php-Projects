var plan = require('flightplan');

var nodePath = '/Users/cesar/.nvm/v0.10.33/bin/';

var newRelease = new Date().getTime();

var config = {
  deployTo: '/var/www/apps/web',
  keepReleases: 5,
  newReleasePath: '/var/www/apps/web/releases/' + newRelease,
  currentReleasePath: '/var/www/apps/web/current',
  tmpDir: '/tmp/iceangel_web/'
};

plan.target('production', {
  host: '52.76.58.114',
  username: 'iceangel',
  // privateKey: '/home/cesar/.ssh/id_rsa',
  agent: process.env.SSH_AUTH_SOCK
}, {
  configFile: 'production'
});

plan.target('tianshijiuyuan', {
  host: '139.196.243.214',
  username: 'iceangel',
  // privateKey: '/home/cesar/.ssh/id_rsa',
  agent: process.env.SSH_AUTH_SOCK
}, {
  configFile: 'tianshijiuyuan'
});

plan.target('staging', {
  host: '54.255.215.64',
  username: 'iceangel',
  // privateKey: '/home/cesar/.ssh/id_rsa',
  agent: process.env.SSH_AUTH_SOCK
}, {
  configFile: 'staging'
});

plan.local('deploy', localTasks);

plan.remote('deploy', remoteTasks);

plan.remote('rollback', rollbackTasks);

function localTasks(local) {

  local.log('Replace config with '+ plan.runtime.options.configFile);
  local.exec('./node_modules/.bin/gulp config --target ' + plan.runtime.options.configFile);

  local.log('Run build');

  local.log('Add fonts to release');
  local.exec('./node_modules/.bin/gulp fonts');

  local.exec('./node_modules/.bin/gulp release:web');

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

