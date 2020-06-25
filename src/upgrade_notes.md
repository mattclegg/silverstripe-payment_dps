2020-06-26 10:51

# running php upgrade inspect see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/payment_dps
php /var/www/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code inspect /var/www/upgrades/payment_dps/payment_dps/src  --root-dir=/var/www/upgrades/payment_dps --write -vvv
Array
(
    [0] => Running post-upgrade on "/var/www/upgrades/payment_dps/payment_dps/src"
    [1] => [2020-06-26 10:51:20] Applying ApiChangeWarningsRule to DpsPxPayment_Handler.php...
    [2] => PHP Fatal error:  Cannot declare class Sunnysideup\PaymentDps\Control\DpsPxPayPayment_Handler, because the name is already in use in /var/www/upgrades/payment_dps/payment_dps/src/Control/DpsPxPayment_Handler.php on line 67
)


------------------------------------------------------------------------
To continue, please use the following parameter: startFrom=InspectAPIChanges-1
e.g. php runme.php startFrom=InspectAPIChanges-1
------------------------------------------------------------------------
            
# running php upgrade inspect see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/payment_dps
php /var/www/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code inspect /var/www/upgrades/payment_dps/payment_dps/src  --root-dir=/var/www/upgrades/payment_dps --write -vvv
Array
(
    [0] => Running post-upgrade on "/var/www/upgrades/payment_dps/payment_dps/src"
    [1] => [2020-06-26 10:54:20] Applying ApiChangeWarningsRule to DpsPxPayment_Handler.php...
    [2] => PHP Fatal error:  Cannot declare class Sunnysideup\PaymentDps\Control\DpsPxPayPayment_Handler, because the name is already in use in /var/www/upgrades/payment_dps/payment_dps/src/Control/DpsPxPayment_Handler.php on line 67
)


------------------------------------------------------------------------
To continue, please use the following parameter: startFrom=InspectAPIChanges-1
e.g. php runme.php startFrom=InspectAPIChanges-1
------------------------------------------------------------------------
            
# running php upgrade inspect see: https://github.com/silverstripe/silverstripe-upgrader
cd /var/www/upgrades/payment_dps
php /var/www/upgrader/vendor/silverstripe/upgrader/bin/upgrade-code inspect /var/www/upgrades/payment_dps/payment_dps/src  --root-dir=/var/www/upgrades/payment_dps --write -vvv
Writing changes for 0 files
Running post-upgrade on "/var/www/upgrades/payment_dps/payment_dps/src"
[2020-06-26 10:55:24] Applying ApiChangeWarningsRule to DpsPxPayPayment_Handler.php...
[2020-06-26 10:55:24] Applying UpdateVisibilityRule to DpsPxPayPayment_Handler.php...
[2020-06-26 10:55:24] Applying ApiChangeWarningsRule to DpsPxPayStoredPayment_Handler.php...
[2020-06-26 10:55:24] Applying UpdateVisibilityRule to DpsPxPayStoredPayment_Handler.php...
[2020-06-26 10:55:24] Applying ApiChangeWarningsRule to PxPay_Curl.inc.php...
[2020-06-26 10:55:24] Applying UpdateVisibilityRule to PxPay_Curl.inc.php...
[2020-06-26 10:55:24] Applying ApiChangeWarningsRule to DpsPxPayStoredPayment.php...
[2020-06-26 10:55:24] Applying UpdateVisibilityRule to DpsPxPayStoredPayment.php...
[2020-06-26 10:55:24] Applying ApiChangeWarningsRule to DpsPxPost.php...
[2020-06-26 10:55:25] Applying UpdateVisibilityRule to DpsPxPost.php...
[2020-06-26 10:55:25] Applying ApiChangeWarningsRule to DpsPxPayComs.php...
[2020-06-26 10:55:25] Applying UpdateVisibilityRule to DpsPxPayComs.php...
[2020-06-26 10:55:25] Applying ApiChangeWarningsRule to DpsPxPayPayment.php...
[2020-06-26 10:55:25] Applying UpdateVisibilityRule to DpsPxPayPayment.php...
[2020-06-26 10:55:25] Applying ApiChangeWarningsRule to DpsPxPayStoredCard.php...
[2020-06-26 10:55:25] Applying UpdateVisibilityRule to DpsPxPayStoredCard.php...
unchanged:	DpsPxPayStoredPayment.php
Warnings for DpsPxPayStoredPayment.php:
 - DpsPxPayStoredPayment.php:83 THIRDPARTY_DIR: Path constants have been deprecated. Use the Requirements and ModuleResourceLoader APIs (https://docs.silverstripe.org/en/4/changelogs/4.0.0#module-paths)
unchanged:	DpsPxPayPayment.php
Warnings for DpsPxPayPayment.php:
 - DpsPxPayPayment.php:209 THIRDPARTY_DIR: Path constants have been deprecated. Use the Requirements and ModuleResourceLoader APIs (https://docs.silverstripe.org/en/4/changelogs/4.0.0#module-paths)
Writing changes for 0 files
✔✔✔