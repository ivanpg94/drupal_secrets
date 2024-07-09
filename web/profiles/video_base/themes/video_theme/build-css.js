const postcss = require('postcss');
const fs = require('fs');
const path = require('path');
const fg = require('fast-glob');
const chokidar = require('chokidar');
const autoprefixer = require('autoprefixer');
const nested = require('postcss-nested');

const srcDir = 'assets/pcss';
const destDir = 'assets/css';

async function compileCss() {
  try {
    console.log('Buscando archivos en:', path.resolve(srcDir));

    const files = await fg(`${path.resolve(srcDir)}/**/*.pcss.css`);
    console.log('Archivos encontrados:', files);

    for (const file of files) {
      await processFile(file);
    }
  } catch (err) {
    console.error('Error durante la compilación:', err);
  }
}

async function processFile(file) {
  try {
    const relativePath = path.relative(srcDir, file);
    const destPath = path.resolve(destDir, relativePath.replace('.pcss.css', '.css'));

    console.log('Procesando archivo:', file);

    const css = await fs.promises.readFile(file);

    const result = await postcss([nested, autoprefixer]).process(css, { from: file, to: destPath });

    await fs.promises.mkdir(path.dirname(destPath), { recursive: true });
    await fs.promises.writeFile(destPath, result.css);
    console.log(`Archivo compilado: ${file} a ${destPath}`);

    if (result.map) {
      await fs.promises.writeFile(destPath + '.map', result.map.toString());
    }
  } catch (err) {
    console.error(`Error al procesar el archivo ${file}:`, err);
  }
}

function watchFiles() {
  const watcher = chokidar.watch(`${srcDir}/**/*.pcss.css`, {
    persistent: true,
  });

  watcher
    .on('add', filePath => processFile(filePath))
    .on('change', filePath => processFile(filePath))
    .on('unlink', filePath => {
      const relativePath = path.relative(srcDir, filePath);
      const destPath = path.resolve(destDir, relativePath.replace('.pcss.css', '.css'));
      fs.promises.unlink(destPath).then(() => {
        console.log(`Archivo eliminado: ${destPath}`);
      }).catch(err => {
        console.error(`Error al eliminar el archivo ${destPath}:`, err);
      });
    });

  console.log('Observando cambios en los archivos...');
}

if (process.argv.includes('--watch')) {
  watchFiles();
} else {
  compileCss();
}
