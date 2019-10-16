A custom module for [beverageuniverse.com](https://beverageuniverse.com) (Magento 2).
It limits the Milkman products to Manhattan and some nearby areas. 

## How to install
```
bin/magento maintenance:enable
rm -rf composer.lock
composer clear-cache
composer require beverageuniverse/manhattan:*
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
bin/magento cache:enable
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme Magento/Beverage \
	-f en_US
bin/magento maintenance:disable
```

## How to upgrade
```
bin/magento maintenance:enable
composer remove beverageuniverse/manhattan
rm -rf composer.lock
composer clear-cache
composer require beverageuniverse/manhattan:*
bin/magento setup:upgrade
rm -rf var/di var/generation generated/code
bin/magento setup:di:compile
bin/magento cache:enable
rm -rf pub/static/*
bin/magento setup:static-content:deploy \
	--area adminhtml \
	--theme Magento/backend \
	-f en_US
bin/magento setup:static-content:deploy \
	--area frontend \
	--theme Magento/Beverage \
	-f en_US
bin/magento maintenance:disable
```