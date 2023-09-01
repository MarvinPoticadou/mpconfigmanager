const path = require('path');
const Encore = require('@symfony/webpack-encore');
const psRootDir = path.resolve(process.env.PWD, '../../');
const psJsDir = path.resolve(psRootDir, '4mondesadmin/themes/new-theme/js');
const psAppDir = path.resolve(psJsDir, 'app');
const psComponentsDir = path.resolve(psJsDir, 'components');

Encore
  .setOutputPath('public/build/')
  .setPublicPath('/modules/mpconfigmanager/public/build')
  .addEntry('grid', './assets/js/grid.js')
  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()
  .enableSourceMaps(!Encore.isProduction())
  .enableSassLoader()
  .addAliases({'@app': psAppDir, '@components' : psComponentsDir})
;

module.exports = Encore.getWebpackConfig();
