set :stages, ["develop", "staging", "staging_tian", "production", "tianshijiuyuan"]
set :default_stage, "staging"

# config valid only for current version of Capistrano
lock '3.8.0'

set :application, 'iceangelid_api'
set :repo_url, 'ssh://git@bitbucket.org/iceangelid/ice-angel-id-api.git'

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, '/var/www/apps/api'
set :deploy_to, '/home/iceangel/apps/api'


set :user, "iceangel"

# Default value for :log_level is :debug
set :log_level, :debug

# Default value for :pty is false
set :pty, true

# Default value for :linked_files is []
# set :linked_files, fetch(:linked_files, []).push('config/database.yml', 'config/secrets.yml')

set :linked_dirs, fetch(:linked_dirs, []).push('public/uploads', 'app/storage/cache', 'app/storage/logs', 'app/storage/meta', 'app/storage/sessions', 'app/storage/views')


namespace :deploy do

  desc 'Get stuff ready prior to symlinking'
  task :move_vendor_and_config do
    on roles(:app), in: :sequence, wait: 1 do
      within release_path do
        execute "cp #{fetch(:config_dir)}/env.php #{fetch(:release_path)}/.env.php"
        execute "cp -r #{fetch(:composer_vendor)}/vendor #{fetch(:release_path)}"
        # execute "ln -snf #{fetch(:maxmind_db)}/GeoLite2-City.mmdb #{fetch(:release_path)}/app/database/maxmind/GeoLite2-City.mmdb"
        execute "mkdir -p #{fetch(:release_path)}/public/assets/fonts/"
        execute "ln -snf #{fetch(:fonts)}/ARIALUNI.TTF #{fetch(:release_path)}/public/assets/fonts/ARIALUNI.TTF"
      end
    end
  end

  after :updated, :move_vendor_and_config
  
  before "deploy:updated", "deploy:set_permissions:acl"

  namespace :ops do

    namespace :config do

      desc 'Upload environment configuration to servers.'
      task :upload_env do
        on roles(:app), in: :sequence, wait: 1 do
          execute "mkdir -p #{fetch(:config_dir)}"
          upload! "./.env.#{fetch(:app_environment)}.php", "#{fetch(:config_dir)}/env.php"
          # upload! "./vendor", "#{fetch(:deploy_to)}, recursive: true"
        end
      end

    end

    namespace :composer do

      desc 'Install/Update composer dependencies'
      task :install_no_dev do
        on release_roles(:app) do
          within fetch(:release_path) do
            execute :composer, 'update --no-dev --prefer-dist --no-interaction --quiet --optimize-autoloader'
          end
        end
      end

      desc 'Copy vendor folder to servers.'
      task :upload_vendor do
        on roles(:app), in: :sequence, wait: 1 do
          system("mkdir build && tar -zcf ./build/vendor.tar.gz ./vendor")
          execute "mkdir -p #{fetch(:composer_vendor)}"
          upload! './build/vendor.tar.gz', fetch(:composer_vendor), :recursive => true
          execute "cd #{fetch(:composer_vendor)}
          tar -zxf #{fetch(:composer_vendor)}/vendor.tar.gz
          rm #{fetch(:composer_vendor)}/vendor.tar.gz"
          system("rm -rf build")
        end
      end  

    end

    namespace :services do

      desc 'Restart supervisor, nginx, php-fpm commands'
      task :restart_all do
        on roles(:app) do
          execute "sudo service php-fpm restart || sudo service php-fpm-5.5 restart"
          # execute "sudo supervisorctl restart all"
          execute "sudo nginx -s reload"
        end
      end

    end

    namespace :maxmind do

      desc 'Update maxmind geolite2 database'
      task :update do
        on roles(:app) do
          execute "cd /tmp
          wget http://geolite.maxmind.com/download/geoip/database/GeoLite2-City.mmdb.gz
          gunzip GeoLite2-City.mmdb.gz
          mv GeoLite2-City.mmdb #{fetch(:maxmind_db)}
          ln -snf #{fetch(:maxmind_db)}/GeoLite2-City.mmdb #{fetch(:deploy_to)}/current/app/database/maxmind/GeoLite2-City.mmdb"
        end
      end

    end

    # namespace :wkhtmltox do

    #   desc 'Install wkhtmltox and dependencies'
    #   task :update do
    #     on roles(:app) do
    #       execute "cd /tmp
    #       wget http://geolite.wkhtmltox.com/download/geoip/database/GeoLite2-City.mmdb.gz
    #       gunzip GeoLite2-City.mmdb.gz
    #       mv GeoLite2-City.mmdb #{fetch(:wkhtmltox_db)}
    #       ln -snf #{fetch(:wkhtmltox_db)}/GeoLite2-City.mmdb #{fetch(:deploy_to)}/current/app/database/wkhtmltox/GeoLite2-City.mmdb"
    #     end
    #   end

    # end

  end

  after "deploy:finished", "deploy:ops:services:restart_all"

end


