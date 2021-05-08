call npm run buildcss
cd dist
cd ..
curl localhost:8088 -o dist/index.html
mkdir dist\imgs
mkdir dist\js
copy imgs dist\imgs
copy js dist\js
copy favicon.ico dist\favicon.ico
copy robots.txt dist\robots.txt
tree /F dist
REM start firefox dist/index.html