<?php

// +----------------------------------------------------------------------
// | 跳转设置
// +----------------------------------------------------------------------

return [
    // 默认跳转页面对应的模板文件
    'dispatch_success_tmpl' => app()->getAppPath(). '/common/view/tpl/dispatch_jump_nice.tpl',
    'dispatch_error_tmpl'   => app()->getAppPath(). '/common/view/tpl/dispatch_jump.tpl',
];

