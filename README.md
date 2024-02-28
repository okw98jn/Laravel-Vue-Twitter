# Twitter Clone

1. `git clone https://github.com/okw98jn/Laravel-Vue-Twitter.git` - リポジトリをクローン
2. `cp .env.example .env` - envファイルをコピー
3. `make clone` - コンテナ作成からnpm run devまで実行
4. Minioコンソールにログイン： [http://localhost:9090](http://localhost:9090)
   - ユーザー名：`minio_root`
   - パスワード：`minio_password`
5. Buckets→laravel-vue-twitter→Access Policyをpublicに変更
6. http://localhost:8000
 
- **テストユーザー**  
  - メールアドレス：`test@example.com`  
  - パスワード：`1234`

