<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

return [
		'news/:id'	=> 'index/index/info',
		'/gateway/bind'=>'index/GatewayServer/bind',
		'/gateway/send'=>'index/GatewayServer/send',
		
		// 注册直播相关事件回调
		'/on_publish'      =>'index/Rtmp/onPublish',        // 推流输出
		'/on_publish_done' =>'index/Rtmp/onPublishDone',     // 推流结束
		'/on_play'         =>'index/Rtmp/onPlay',           // 播放
		'/on_play_done'    =>'index/Rtmp/onPlayDone',       // 客户端播放结束
		'/ffmpeg_photo'    =>'index/Rtmp/ffmpegPhoto',      // 截取视频流截图
];
