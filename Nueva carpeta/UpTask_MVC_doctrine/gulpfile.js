import { src, dest, watch, series } from 'gulp'
import * as dartSass from 'sass'
import gulpSass from 'gulp-sass'
import plumber from 'gulp-plumber' // Importa gulp-plumber
import terser from 'gulp-terser'

const sass = gulpSass(dartSass)

const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js'
}

export function css( done ) {
    src(paths.scss, {sourcemaps: true})
        .pipe(plumber()) // Agrega esta línea para manejar los errores
        .pipe( sass({
            outputStyle: 'compressed'
        }).on('error', sass.logError) )
        .pipe( dest('./public/build/css', {sourcemaps: '.'}) );
    done()
}

export function js( done ) {
    src(paths.js)
      .pipe(terser())
      .pipe(dest('./public/build/js'))
    done()
}

export function dev() {
    watch( paths.scss, css );
    watch( paths.js, js );
}

export default series( js, css, dev )