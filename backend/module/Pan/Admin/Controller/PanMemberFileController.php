<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Pan\Admin\Controller; use Illuminate\Routing\Controller; use ModStart\Admin\Concern\HasAdminQuickCRUD; use ModStart\Admin\Layout\AdminCRUDBuilder; use ModStart\Core\Util\FileUtil; use ModStart\Field\AbstractField; use ModStart\Field\AutoRenderedFieldValue; use ModStart\Support\Concern\HasFields; class PanMemberFileController extends Controller { use HasAdminQuickCRUD; protected function crud(AdminCRUDBuilder $xD3VI) { $xD3VI->init('pan_member_file')->field(function ($xD3VI) { $xD3VI->id('id', 'ID'); $xD3VI->display('fileName', '名称'); $xD3VI->display('size', '大小')->hookRendering(function (AbstractField $gHm4b, $nivms, $ltyOC) { return AutoRenderedFieldValue::make(FileUtil::formatByte($nivms->size)); }); $xD3VI->display('uploadTime', '上传时间'); $xD3VI->display('fileId', '物理文件ID'); $xD3VI->switch('isFolder', '文件夹')->optionsYesNo(); $xD3VI->switch('isDelete', '已删除')->optionsYesNo(); $xD3VI->display('created_at', L('Created At')); $xD3VI->display('updated_at', L('Updated At')); })->disableCUD()->title('用户文件'); } }