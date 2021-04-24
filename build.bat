call npm run buildcss
cd dist
cd ..
curl localhost:8088 -o dist/index.html
mkdir dist\imgs
copy imgs dist\imgs
copy favicon.ico dist\favicon.ico
copy robots.txt dist\robots.txt
tree /F dist
start firefox dist/index.html