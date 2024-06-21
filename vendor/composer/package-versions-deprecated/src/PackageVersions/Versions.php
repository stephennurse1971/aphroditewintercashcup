<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = '__root__';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'behat/transliterator' => 'v1.5.0@baac5873bac3749887d28ab68e2f74db3a4408af',
  'composer/package-versions-deprecated' => '1.11.99.5@b4f54f74ef3453349c24a845d22392cd31e65f1d',
  'doctrine/annotations' => '2.0.1@e157ef3f3124bbf6fe7ce0ffd109e8a8ef284e7f',
  'doctrine/cache' => '2.2.0@1ca8f21980e770095a31456042471a57bc4c68fb',
  'doctrine/collections' => '1.8.0@2b44dd4cbca8b5744327de78bafef5945c7e7b5e',
  'doctrine/common' => '3.4.3@8b5e5650391f851ed58910b3e3d48a71062eeced',
  'doctrine/dbal' => '2.13.9@c480849ca3ad6706a39c970cdfe6888fa8a058b8',
  'doctrine/deprecations' => 'v1.0.0@0e2a4f1f8cdfc7a92ec3b01c9334898c806b30de',
  'doctrine/doctrine-bundle' => '2.4.2@4202ce675d29e70a8b9ee763bec021b6f44caccb',
  'doctrine/doctrine-migrations-bundle' => '3.1.1@91f0a5e2356029575f3038432cc188b12f9d5da5',
  'doctrine/event-manager' => '1.2.0@95aa4cb529f1e96576f3fda9f5705ada4056a520',
  'doctrine/inflector' => '2.0.6@d9d313a36c872fd6ee06d9a6cbcf713eaa40f024',
  'doctrine/instantiator' => '1.5.0@0a0fa9780f5d4e507415a065172d26a98d02047b',
  'doctrine/lexer' => '2.1.0@39ab8fcf5a51ce4b85ca97c7a7d033eb12831124',
  'doctrine/migrations' => '3.1.5@537a847ec5525f50f927702fa01b97bacdc2c636',
  'doctrine/orm' => '2.15.1@9bc6f5b4ac6f1e7d4248b2efbd01a748782075bc',
  'doctrine/persistence' => '2.5.7@e36f22765f4d10a7748228babbf73da5edfeed3c',
  'doctrine/sql-formatter' => '1.1.3@25a06c7bf4c6b8218f47928654252863ffc890a5',
  'egulias/email-validator' => '3.2.5@b531a2311709443320c786feb4519cfaf94af796',
  'ezyang/htmlpurifier' => 'v4.16.0@523407fb06eb9e5f3d59889b3978d5bfe94299c8',
  'friendsofphp/proxy-manager-lts' => 'v1.0.14@a527c9d9d5348e012bd24482d83a5cd643bcbc9e',
  'jeroendesloovere/vcard' => 'v1.7.3@2b8b6190c613d368b8cb6552e59cf6e6e7d0aea9',
  'jsvrcek/ics' => '0.4@5ba8a478766f9a2faeda0003b187605555d1b1c3',
  'jsvrcek/ics-bundle' => '1.1@5fd385129d1b9a8cc297625302471bdb9943a2b8',
  'laminas/laminas-code' => '3.4.1@1cb8f203389ab1482bf89c0e70a04849bacd7766',
  'laminas/laminas-eventmanager' => '3.2.1@ce4dc0bdf3b14b7f9815775af9dfee80a63b4748',
  'laminas/laminas-zendframework-bridge' => '1.1.1@6ede70583e101030bcace4dcddd648f760ddf642',
  'maennchen/zipstream-php' => '2.1.0@c4c5803cc1f93df3d2448478ef79394a5981cc58',
  'markbaker/complex' => '3.0.2@95c56caa1cf5c766ad6d65b6344b807c1e8405b9',
  'markbaker/matrix' => '3.0.1@728434227fe21be27ff6d86621a1b13107a2562c',
  'monolog/monolog' => '2.9.1@f259e2b15fb95494c83f52d3caad003bbf5ffaa1',
  'myclabs/php-enum' => '1.7.7@d178027d1e679832db9f38248fcc7200647dc2b7',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.3.0@622548b623e81ca6d78b721c5e029f4ce664f170',
  'phpdocumentor/type-resolver' => '1.6.1@77a32518733312af16a44300404e945338981de3',
  'phpoffice/phpspreadsheet' => '1.19.0@a9ab55bfae02eecffb3df669a2e19ba0e2f04bbf',
  'phpstan/phpdoc-parser' => '1.20.4@7d568c87a9df9c5f7e8b5f075fc469aa8cb0a4cd',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-client' => '1.0.2@0955afe48220520692d2d09f7ab7e0f93ffd6a31',
  'psr/http-factory' => '1.0.2@e616d01114759c4c489f93b099585439f795fe35',
  'psr/http-message' => '1.1@cb6ce4845ce34a8ad9e68117c10ee90a29919eba',
  'psr/link' => '1.0.0@eea8e8662d5cd3ae4517c9b864493f59fca95562',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'sensio/framework-extra-bundle' => 'v6.2.10@2f886f4b31f23c76496901acaedfedb6936ba61f',
  'symfony/amqp-messenger' => 'v5.4.22@6343af983ba7460f7ea984aacb95d1ed382f6e40',
  'symfony/apache-pack' => 'v1.0.1@3aa5818d73ad2551281fc58a75afd9ca82622e6c',
  'symfony/asset' => 'v5.4.21@1504b6773c6b90118f9871e90a67833b5d1dca3c',
  'symfony/cache' => 'v5.4.23@983c79ff28612cdfd66d8e44e1a06e5afc87e107',
  'symfony/cache-contracts' => 'v2.5.2@64be4a7acb83b6f2bf6de9a02cee6dad41277ebc',
  'symfony/config' => 'v5.4.21@2a6b1111d038adfa15d52c0871e540f3b352d1e4',
  'symfony/console' => 'v5.4.23@90f21e27d0d88ce38720556dd164d4a1e4c3934c',
  'symfony/dependency-injection' => 'v5.4.23@bb7b7988c898c94f5338e16403c52b5a3cae1d93',
  'symfony/deprecation-contracts' => 'v2.5.2@e8b495ea28c1d97b5e0c121748d6f9b53d075c66',
  'symfony/doctrine-bridge' => 'v5.4.23@32cddf41cf6abfc4c3db68568c785e48eebf3d71',
  'symfony/doctrine-messenger' => 'v5.4.23@1667cc4d3b2741ada859f76743d25936d3617909',
  'symfony/dotenv' => 'v5.4.22@77b7660bfcb85e8f28287d557d7af0046bcd2ca3',
  'symfony/error-handler' => 'v5.4.23@218206b4772d9f412d7d277980c020d06e9d8a4e',
  'symfony/event-dispatcher' => 'v5.4.22@1df20e45d56da29a4b1d8259dd6e950acbf1b13f',
  'symfony/event-dispatcher-contracts' => 'v2.5.2@f98b54df6ad059855739db6fcbc2d36995283fe1',
  'symfony/expression-language' => 'v5.4.21@501589522b844b8eecf012c133f0404f0eef77ac',
  'symfony/filesystem' => 'v5.4.23@b2f79d86cd9e7de0fff6d03baa80eaed7a5f38b5',
  'symfony/finder' => 'v5.4.21@078e9a5e1871fcfe6a5ce421b539344c21afef19',
  'symfony/flex' => 'v1.19.5@51077ed0f6dc2c94cd0b670167eee3747c31b2c1',
  'symfony/form' => 'v5.4.23@ebdc48d54d82b74230a8aed6458c238ec5788e38',
  'symfony/framework-bundle' => 'v5.4.22@6cb4f6aed4bd7fbf7b2ee74c231184a07f3d00c1',
  'symfony/http-client' => 'v5.4.23@617c98e46b54e43ca76945a908b1749bb82f4478',
  'symfony/http-client-contracts' => 'v2.5.2@ba6a9f0e8f3edd190520ee3b9a958596b6ca2e70',
  'symfony/http-foundation' => 'v5.4.23@af9fbb378f5f956c8f29d4886644c84c193780ac',
  'symfony/http-kernel' => 'v5.4.23@48ea17a7c65ef1ede0c3b2dbc35adace99071810',
  'symfony/intl' => 'v5.4.23@962789bbc76c82c266623321ffc24416f574b636',
  'symfony/mailer' => 'v5.4.22@6330cd465dfd8b7a07515757a1c37069075f7b0b',
  'symfony/messenger' => 'v5.4.23@f81b9dab3d9a2f0519a4e1d077a0d40f8978bcb0',
  'symfony/mime' => 'v5.4.23@ae0a1032a450a3abf305ee44fc55ed423fbf16e3',
  'symfony/monolog-bridge' => 'v5.4.22@34be6f0695e4187dbb832a05905fb4c6581ac39a',
  'symfony/monolog-bundle' => 'v3.8.0@a41bbcdc1105603b6d73a7d9a43a3788f8e0fb7d',
  'symfony/notifier' => 'v5.4.22@5ea626671ee3875f32c887467a47697bed83e6d4',
  'symfony/options-resolver' => 'v5.4.21@4fe5cf6ede71096839f0e4b4444d65dd3a7c1eb9',
  'symfony/password-hasher' => 'v5.4.21@7ce4529b2b2ea7de3b6f344a1a41f58201999180',
  'symfony/polyfill-intl-grapheme' => 'v1.27.0@511a08c03c1960e08a883f4cffcacd219b758354',
  'symfony/polyfill-intl-icu' => 'v1.27.0@a3d9148e2c363588e05abbdd4ee4f971f0a5330c',
  'symfony/polyfill-intl-idn' => 'v1.27.0@639084e360537a19f9ee352433b84ce831f3d2da',
  'symfony/polyfill-intl-normalizer' => 'v1.27.0@19bd1e4fcd5b91116f14d8533c57831ed00571b6',
  'symfony/polyfill-mbstring' => 'v1.27.0@8ad114f6b39e2c98a8b0e3bd907732c207c2b534',
  'symfony/polyfill-php73' => 'v1.27.0@9e8ecb5f92152187c4799efd3c96b78ccab18ff9',
  'symfony/polyfill-php80' => 'v1.27.0@7a6ff3f1959bb01aefccb463a0f2cd3d3d2fd936',
  'symfony/polyfill-php81' => 'v1.27.0@707403074c8ea6e2edaf8794b0157a0bfa52157a',
  'symfony/process' => 'v5.4.23@4b842fc4b61609e0a155a114082bd94e31e98287',
  'symfony/property-access' => 'v5.4.22@ffee082889586b5718347b291e04071f4d07b38f',
  'symfony/property-info' => 'v5.4.23@ff45ebbfd781eab2571d9d4412d82a9a733fc2b3',
  'symfony/redis-messenger' => 'v5.4.23@d9c0a6d7e3e925817f1ce7ec7416cc0e29b331e1',
  'symfony/routing' => 'v5.4.22@c2ac11eb34947999b7c38fb4c835a57306907e6d',
  'symfony/runtime' => 'v5.4.22@4a78e519d40a3845437e29dc514959631badfed4',
  'symfony/security-bundle' => 'v5.4.22@36eddff8266126de032ab528417ad13eb43f6cb5',
  'symfony/security-core' => 'v5.4.22@a801d525c7545332e2ddf7f52c163959354b1650',
  'symfony/security-csrf' => 'v5.4.21@776a538e5f20fb560a182f790979c71455694203',
  'symfony/security-guard' => 'v5.4.22@62d064b1ee682e4617f4c5ddc0d31f73e1a7ecaa',
  'symfony/security-http' => 'v5.4.23@6791856229cc605834d169091981e4eae77dad45',
  'symfony/serializer' => 'v5.4.23@545da11697153c24c274b9a68cab550b2c0a9860',
  'symfony/service-contracts' => 'v2.5.2@4b426aac47d6427cc1a1d0f7e2ac724627f5966c',
  'symfony/stopwatch' => 'v5.4.21@f83692cd869a6f2391691d40a01e8acb89e76fee',
  'symfony/string' => 'v5.4.22@8036a4c76c0dd29e60b6a7cafcacc50cf088ea62',
  'symfony/translation' => 'v5.4.22@9a401392f01bc385aa42760eff481d213a0cc2ba',
  'symfony/translation-contracts' => 'v2.5.2@136b19dd05cdf0709db6537d058bcab6dd6e2dbe',
  'symfony/twig-bridge' => 'v5.4.22@e5b174464f68be6876046db3ad6e217d9a7dbbac',
  'symfony/twig-bundle' => 'v5.4.21@875d0edfc8df7505c1993419882c4071fc28c477',
  'symfony/validator' => 'v5.4.23@ca71f5562a3876a153250f638124b6b95452985f',
  'symfony/var-dumper' => 'v5.4.23@9a8a5b6d6508928174ded2109e29328a55342a42',
  'symfony/var-exporter' => 'v5.4.21@be74908a6942fdd331554b3cec27ff41b45ccad4',
  'symfony/web-link' => 'v5.4.21@57c03a5e89ed7c2d7a1a09258dfec12f95f95adb',
  'symfony/yaml' => 'v5.4.23@4cd2e3ea301aadd76a4172756296fe552fb45b0b',
  'symfonycasts/reset-password-bundle' => 'v1.17.0@6601f15fce7a4934bc9570f76feaf1b93536b1a7',
  'symfonycasts/verify-email-bundle' => 'v1.13.0@eb7bc997f36ad872a0d56bf209fe37fed148b0a7',
  'twig/extra-bundle' => 'v3.6.0@4a9674e775f49a9df5e26da66546e8f3364afe67',
  'twig/twig' => 'v3.6.0@106c170d08e8415d78be2d16c3d057d0d108262b',
  'webmozart/assert' => '1.11.0@11cb2199493b2f8a3b53e7f19068fc6aac760991',
  'welp/ical-bundle' => '1.0.1@b1e0d8adab396a54dae745c070fb99bb18778f49',
  'myclabs/deep-copy' => '1.11.1@7284c22080590fb39f2ffa3e9057f10a4ddd0e0c',
  'nikic/php-parser' => 'v4.15.4@6bb5176bc4af8bcb7d926f88718db9b96a2d4290',
  'phar-io/manifest' => '2.0.3@97803eca37d319dfa7826cc2437fc020857acb53',
  'phar-io/version' => '3.2.1@4f7fd7836c6f332bb2933569e566a0d6c4cbed74',
  'phpunit/php-code-coverage' => '7.0.15@819f92bba8b001d4363065928088de22f25a3a48',
  'phpunit/php-file-iterator' => '2.0.5@42c5ba5220e6904cbfe8b1a1bda7c0cfdc8c12f5',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/php-token-stream' => '3.1.3@9c1da83261628cb24b6a6df371b6e312b3954768',
  'phpunit/phpunit' => '8.5.33@7d1ff0e8c6b35db78ff13e3e05517d7cbf7aa32e',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '3.0.5@1dc7ceb4a24aede938c7af2a9ed1de09609ca770',
  'sebastian/diff' => '3.0.4@6296a0c086dd0117c1b78b059374d7fcbe7545ae',
  'sebastian/environment' => '4.2.4@d47bbbad83711771f167c72d4e3f25f7fcc1f8b0',
  'sebastian/exporter' => '3.1.5@73a9676f2833b9a7c36968f9d882589cd75511e6',
  'sebastian/global-state' => '3.0.2@de036ec91d55d2a9e0db2ba975b512cdb1c23921',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/resource-operations' => '2.0.2@31d35ca87926450c44eae7e2611d45a7a65ea8b3',
  'sebastian/type' => '1.1.4@0150cfbc4495ed2df3872fb31b26781e4e077eb4',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'symfony/browser-kit' => 'v5.4.21@a866ca7e396f15d7efb6d74a8a7d364d4e05b704',
  'symfony/css-selector' => 'v5.4.21@95f3c7468db1da8cc360b24fa2a26e7cefcb355d',
  'symfony/debug-bundle' => 'v5.4.21@8b4360bf8ce9a917ef8796c5e6065a185d8722bd',
  'symfony/dom-crawler' => 'v5.4.23@4a286c916b74ecfb6e2caf1aa31d3fe2a34b7e08',
  'symfony/maker-bundle' => 'v1.43.0@e3f9a1d9e0f4968f68454403e820dffc7db38a59',
  'symfony/phpunit-bridge' => 'v6.2.10@552950db2919421ad917e29e76d1999a2a31a8e3',
  'symfony/web-profiler-bundle' => 'v5.4.21@a83337a813d1398789bf4190a56dc3c4d8cc4d93',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'symfony/polyfill-ctype' => '*@5489308a36fdbf260bdabee36b4f1562ce4d5020',
  'symfony/polyfill-iconv' => '*@5489308a36fdbf260bdabee36b4f1562ce4d5020',
  'symfony/polyfill-php72' => '*@5489308a36fdbf260bdabee36b4f1562ce4d5020',
  '__root__' => 'dev-main@5489308a36fdbf260bdabee36b4f1562ce4d5020',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!self::composer2ApiUsable()) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (self::composer2ApiUsable()) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }

    private static function composer2ApiUsable(): bool
    {
        if (!class_exists(InstalledVersions::class, false)) {
            return false;
        }

        if (method_exists(InstalledVersions::class, 'getAllRawData')) {
            $rawData = InstalledVersions::getAllRawData();
            if (count($rawData) === 1 && count($rawData[0]) === 0) {
                return false;
            }
        } else {
            $rawData = InstalledVersions::getRawData();
            if ($rawData === null || $rawData === []) {
                return false;
            }
        }

        return true;
    }
}
