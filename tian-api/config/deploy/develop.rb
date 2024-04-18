
role :app, %w{api.iceangelid.biz}

set :ssh_options, {
  user: 'iceangel'
}

set :tmp_dir, '/tmp'

set :branch, 'develop'

set :composer_vendor, fetch(:deploy_to) + '/vendor'
set :config_dir, fetch(:deploy_to) + '/config'
set :maxmind_db, fetch(:deploy_to) + '/maxmind'
set :fonts, fetch(:deploy_to) + '/shared/public/fonts'


set :file_permissions_paths, ['public', 'public/uploads', 'app/storage/cache', 'app/storage/logs', 'app/storage/meta', 'app/storage/sessions', 'app/storage/views', 'public/tmp']
set :file_permissions_users, ["iceangel"]
set :file_permissions_groups, ["iceangel"]
set :file_permissions_chmod_mode, "0777"

set :app_environment, 'develop'
