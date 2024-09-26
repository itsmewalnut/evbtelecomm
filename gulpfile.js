const gulp = require("gulp");
const clean = require("gulp-clean");

// Clean dist folder
gulp.task("clean", function () {
  return gulp.src("dist", { allowEmpty: true }).pipe(clean());
});

// Copy PHP files
gulp.task("copy-php", function () {
  return gulp.src(["*.php"]).pipe(gulp.dest("dist"));
});

// Copy assets and other directories
gulp.task("copy-assets", function () {
  return gulp
    .src([
      "assets/**/*",
      "backend/**/*",
      "database/**/*",
      "image/**/*",
      "plugins/**/*",
      "query/**/*",
      "users/**/*",
      "style.css",
      "index.php",
      "login.php",
      "logout.php",
    ])
    .pipe(gulp.dest("dist"));
});

// Default task to clean and copy files
gulp.task("default", gulp.series("clean", "copy-php", "copy-assets"));
