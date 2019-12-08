#### 在composer 中添加依赖 



#### 发布前端资源 `php artisan vendor:publish --tag=admin-oss`

#### 相关配置设置

在`config/filesystems.php`中新增
```php
'oss'    => [
            'driver'     => 'oss',
            'access_id'  => env('OSS_ACCESS_ID'),
            'access_key' => env('OSS_ACCESS_KEY'),
            'bucket'     => env('OSS_BUCKET'),
            'endpoint'   => env('OSS_ENDPOINT'),
            // OSS 外网节点或自定义外部域名
            'endpoint_internal' => env('OSS_ENDPOINT_INTERNAL'), // v2.0.4 新增配置属性，如果为空，则默认使用 endpoint 配置(由于内网上传有点小问题未解决，请大家暂时不要使用内网节点上传，正在与阿里技术沟通中)
//            'cdnDomain'  => '<CDN domain, cdn域名>',
            // 如果isCName为true, getUrl会判断cdnDomain是否设定来决定返回的url，如果cdnDomain未设置，则使用endpoint来生成url，否则使用cdn
            'ssl'        => env('SSL'),
            // true to use 'https://' and false to use 'http://'. default is false,
            'isCName'    => env('ISCNAME'),
            // 是否使用自定义域名,true: 则Storage.url()会使用自定义的cdn或域名生成文件url， false: 则使用外部节点生成url
            'debug'      => env('DEBUG'),
]
```

#### 用法
```php
//一般用法
$form->customFile('test', '测试'); //单文件上传
$form->customMultiFile('test', '测试'); //多文件上传
$form->customEditor('test', '测试'); //富文本

//设置参数
$form->customFile('test', '测试')->maxFileSize('10kb')->fileExtensions('rar,mp4,jpg'); //设置上传文件大小和设置文件后缀
```
