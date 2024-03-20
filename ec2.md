## EC2インスタンス作成
#### AMI
Amazon Linux 2 AMI (HVM) - Kernel 5.10, SSD Volume Type

#### インスタンスタイプ
t2.micro

#### キーペア (ログイン) 
- キーペアを作成
- RSA
- .pem

#### ネットワーク設定
- セキュリティグループ作成
- SSH 22
- HTTP 80

#### ストレージ
デフォルト

インスタンス作成後デフォルトセキュリティーグループを追加

## SSH接続
- `mkdir ~/.ssh` 作成済みなら不要
- `mv /Users/username/Downloads/○○○.pem ~/.ssh`
- `chmod 600 /Users/username/.ssh/○○○.pem`
- `ssh -i ~/.ssh/○○○.pem ec2-user@パブリック IPv4 アドレス`
- `sudo yum update`

## Nginxインストール
- `sudo amazon-linux-extras enable nginx1`
- `sudo yum install -y nginx`

## PHPインストール
- `sudo amazon-linux-extras enable php8.2`
- `sudo amazon-linux-extras install -y php8.2`

## Composerインストール
- `php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"`
 ```
php-r "if (hash_file('sha384', 'composer-setup.php') === 'dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
```
- `php composer-setup.php`
- `php -r "unlink('composer-setup.php');"`
- `sudo mv composer.phar /usr/local/bin/composer`

## PHP-FPM設定
- `sudo vim /etc/php-fpm.d/www.conf`
- user、group、listen.owner、listen.groupをnginxに変更
- listen.owner、listen.group、listen.modeのコメント解除

## Nginx設定
- [Nginxの設定をコピー](https://readouble.com/laravel/10.x/ja/deployment.html)
- `sudo vim /etc/nginx/conf.d/laravel.conf`
- `:set paste`
- コピーした設定を貼り付け
- `listen 80 default_server`
- `root /var/www/プロジェクト名/public;`
- `fastcgi_pass unix:/run/php-fpm/www.sock;`

## Node.jsインストール
- `curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.7/install.sh | bash`
- `source ~/.bashrc`
- `nvm install v16.14.0`

## アプリ設定
- `sudo yum install git`
- `sudo mkdir /var/www/`
- `sudo chown ec2-user:ec2-user /var/www`
- `cd /var/www/`
- `git clone`
- `cd プロジェクト名`
- `sudo chmod -R 777 storage/`
- `sudo yum install php-mbstring`
- `sudo yum install php-dom`
- `composer install`
- `cp .env.example .env`
- `.envを本番用に適宜変更`
- `php artisan key:generate`
- `npm install`
- `npm run build`
- `sudo systemctl start nginx`
- `sudo systemctl start php-fpm`

## DB
- 標準作成
- MySQL
- パスワード自動設定
- デフォルトセキュリティーグループ使う
- パスワード控える
- `cd ~`
- `sudo yum install mysql`
- `sudo vim .env`
- `DB_HOST=エンドポイント`
- `DB_USERNAME=admin`
- `DB_PASSWORD=控えたパスワード`
- `mysql -h エンドポイント -u admin -p`
- `create database laravel_app;`
- `php artisan migrate`
