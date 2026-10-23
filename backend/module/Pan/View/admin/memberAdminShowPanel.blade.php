<form action="{{modstart_admin_url('pan/member')}}" data-ajax-form method="post">
    <input type="hidden" name="memberUserId" value="{{$memberUser['id']}}" />
    <div class="ub-form">
        <div class="line">
            <div class="label">已使用：</div>
            <div class="field">
                {{\ModStart\Core\Util\FileUtil::formatByte($memberUser['panSizeUsed'])}}
                <?php
                $userSize = $memberUser['panSizeLimit'];
                if(empty($userSize)){
                    $userSize = modstart_config('Pan_DefaultSizeLimit',1)*1024*1024;
                }
                ?>
                （{{min(100,intval($memberUser['panSizeUsed']*100/max($userSize,1)))}}% ）
            </div>
        </div>
        <div class="line">
            <div class="label">空间大小：</div>
            <div class="field">
                <input type="number" name="panSizeLimit" class="form" value="{{intval($memberUser['panSizeLimit']/1024/1024)}}" />
                <div class="help">
                    单位为MB，留空使用默认大小（{{modstart_config('Pan_DefaultSizeLimit')}}MB）
                </div>
            </div>
        </div>
        <div class="line">
            <div class="label">
                &nbsp;
            </div>
            <div class="field">
                <button type="submit" class="btn">保存网盘设置</button>
            </div>
        </div>
    </div>
</form>
