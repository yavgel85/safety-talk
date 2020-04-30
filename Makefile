.DEFAULT_GOAL := help
.PHONY: help clear
.PHONY: create_db migrate model mysql
.PHONY: debug-bar delete-ui ide-helper passport
.PHONY: phpunit_feature phpunit_unit
.PHONY: start watch

#export USER_ID=$(shell id -u)
#export GROUP_ID=$(shell id -g)
#
include .env

help:									## Show this help.
	@grep -E '(^[a-zA-Z_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":|##"}; {printf "\033[32m%-30s\033[0m %s\n", $$2, $$4}' | sed -e 's/\[32m##/[33m/' | sort

clear:									## Clear route, config and cache
	php artisan route:clear && \
	php artisan view:clear && \
	php artisan config:cache && \
	php artisan config:cache --env=testing && \
	php artisan cache:clear && \
	php artisan config:clear

create_db:								## Create DB
	mysql -uroot -ptest -e "CREATE DATABASE IF NOT EXISTS `${APP_NAME}` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci"

debug-bar:								## Set Debug bar for dev env
	composer require barryvdh/laravel-debugbar --dev

ide-helper:								## Set PHPStorm IDE Healper and add some file to .gitignore
	composer require --dev barryvdh/laravel-ide-helper && \
	php artisan clear-compiled && \
	php artisan ide-helper:generate	&& \
	php artisan ide-helper:meta && \
	echo ".idea" >> .gitignore && \
	echo ".phpstorm.meta.php" >> .gitignore && \
	echo "_ide_helper.php" >> .gitignore
#	add to composer.json:
#	"scripts":{
#        "post-update-cmd": [
#            "Illuminate\\Foundation\\ComposerScripts::postUpdate",
#            "php artisan ide-helper:generate",
#            "php artisan ide-helper:meta"
#        ]
#    },

# make git m="your message"
git:									## Git add, commit and push all in one command
	git add .
	git commit -m "$m"
	git push
	git status
    #git push -u origin master

# example: make mail name=CreateCustomerMail subfolder=customer subname=create-customer
mail:									## Create mail view and controller
	php artisan make:mail $(name) --markdown=mail.$(subfolder).$(subname)

migrate:								## Run migration
	php artisan migrate

migrate-refresh:						## Run migration refresh (truncate all data in DB)
	php artisan migrate:refresh --seed

# -m, --migration   Create a new migration file for the model
# -c, --controller  Create a new controller for the model
# -r, --resource    Indicates if the generated controller should be a resource controller
# -f, --factory     Create a new factory for the model
# -a, --all         Generate a migration, factory, and resource controller for the model
# example: make model name=Post   make model name=Article flags=mc
model:									## Create Model with different mode (localy).
	php artisan make:model $(name) -$(flags)

mysql:									## Run MySQL
	mysql -uroot -ptest

# https://medium.com/modulr/create-api-authentication-with-passport-of-laravel-5-6-1dc2d400a7f
passport:								## Install Laravel Passport Package && Run Migration && Generate keys
	composer require laravel/passport && php artisan migrate && php artisan passport:install
#	add the Laravel\Passport\HasApiTokens trait to App\User model

request:                               ## Create request
	php artisan make:request $(name)

resource-controller:                   ## Create resource Controller
	php artisan make:controller $(name) --resource

# example: php artisan make:rule name=UpperCase    https://www.larashout.com/custom-validation-rules-in-laravel
rule:									## Create custom Rule class
	php artisan make:rule $(name)

seeder:									## Create seeder
	php artisan make:seeder $(name)

seeder-only-one:						## Init only one seeder
	php artisan db:seed --class=$(name)

test_feature:							## Init tests
	vendor/bin/phpunit

test_unit:								## Run tests
	vendor/bin/phpunit tests/Unit/ReplyTest.php

start:									## Start App
	php artisan serve --port=8820

tinker:									## Start Tinker
	php artisan tinker
# example:
# \App\User::create(['first_name' => 'Eugene', 'middle_name' => 'Nikolaevich', 'last_name' => 'Yavgel', 'email' => 'eugene.yavgel@gmail.com', 'dob' => '1985-04-21', 'ssn' => '123-45-6789', 'address1' => 'S.Danchenko, 32-A', 'address2' => 'planet Earth', 'city' => 'Kiev', 'province_id' => '2', 'country' => 'Ukraine', 'zip_code' => '12345', 'phone' => '+38(068)115-85-25', 'password' => bcrypt('Eugene21'),]);
# \App\Customer::create(['bu_id' => '1', 'user_id' => '1', 'unique_id' => '1', 'security_hash' => 'abcdefgihglmnopqrst123456', 'first_name' => 'Eugene', 'middle_name' => 'Nikolaevich', 'last_name' => 'Yavgel', 'dob' => '1985-04-21', 'gender' => 'male', 'address1' => 'S.Danchenko, 32-A', 'address2' => 'planet Earth', 'home_type' => 'apartment', 'city' => 'Kiev', 'province_id' => '2', 'country' => 'Ukraine', 'zip_code' => 'A1A 1A1', 'duration_of_residence' => 'duration_of_residence', 'work_phone' => '+38(068)115-85-25', 'home_phone' => '+38(068)115-85-25', 'cell_phone' => '+38(068)115-85-25', 'pay_cycle_comment' => 'dgfjdfjdhjdj', 'comments' => 'test comment', 'issue_at' => 'issue', 'driving_license' => '783469725nrsgb', 'ssn' => '123-45-6789', 'proof_of_id' => 'fjnsjkdfngjdfkngjkjkjk',]);

# tinker:
# $threads = factory('App\Thread', 50)->create();
# $threads->each(function ($thread) { factory('App\Reply', 10)->create(['thread_id' => $thread->id]); });

watch:									## Watch App
	npm run watch


# PHPStorm не распознает методы моего класса Model в Laravel
# In all Models add:
#
## namespace App;
##
## use Eloquent;
## use Illuminate\Database\Eloquent\Model;
##
## /**
##  * Class Student
##  * @package App
##  * @mixin Eloquent
##  */
## class Student extends Model
## {
##
## }
#
# В качестве последнего шага я нажал Ctrl + Alt + Y (настройки по умолчанию),
# который синхронизируется (File-> Synchronize) в PhpStorm.


# Laravel relationships many to many  https://www.youtube.com/watch?v=GPk3soWIP0E&t=623s
# php artisan make:migration create_business_unit_product_table --create=business_unit_product
# php artisan make:migration create_role_user_table --create=role_user
# php artisan make:migration create_location_product_table --create=location_product
# php artisan make:migration create_location_user_table --create=location_user
