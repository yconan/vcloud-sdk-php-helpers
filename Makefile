all: vendor
	#

clean:
	[ -d vendor ] && rm -Rf vendor

# Composer

vendor: composer.phar
	[ -e composer.lock ] && php composer.phar update || php composer.phar install

composer.phar:
	curl -s http://getcomposer.org/installer | php
