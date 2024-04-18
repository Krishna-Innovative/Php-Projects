var path = require('path');
var fs = require('fs');
var gutil = require('gulp-util');

if (!process.env.ANDROID_HOME) {
  gutil.log(gutil.colors.red('ANDROID_HOME is not set. Android build won\'t work!'));
  return;
}

var androidBuildToolsDir = path.join(process.env.ANDROID_HOME, 'build-tools');

var versions = fs.readdirSync(androidBuildToolsDir);
for (var index in versions) {
  var version = versions[index];
  module.exports[version] = path.join(androidBuildToolsDir, version);
}

var latestVersion = versions.sort()[versions.length - 1];
module.exports['latest'] = path.join(androidBuildToolsDir, latestVersion);
