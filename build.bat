call npm run buildcss
cd dist
mkdir node_modules\@tailwindcss\typography\dist
cd ..
copy node_modules\@tailwindcss\typography\dist\typography.min.css dist\node_modules\@tailwindcss\typography\dist\typography.min.css
curl localhost:8088 -o dist/index.html
mkdir dist\imgs
copy imgs dist\imgs
tree /F dist
start firefox dist/index.html