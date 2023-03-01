# 開発環境構築

## .envを設定
`cp .env.example .env`

## 起動
`docker-compose up -d`

## プロジェクトディレクトリ配下で下記コマンドを実行
```
docker-compose exec laravel php artisan key:generate
docker-compose exec laravel php artisan config:clear
docker-compose exec laravel npm install
docker-compose exec laravel npm run build
```
