call npm run buildcss
cd dist
cd ..
curl localhost:8088 -o dist/index.html
mkdir dist\imgs
copy imgs dist\imgs
tree /F dist
start firefox dist/index.html