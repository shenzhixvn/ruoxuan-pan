<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Vendor\Web\Controller; use Illuminate\Routing\Controller; use Illuminate\Support\Facades\Response; use Intervention\Image\Facades\Image; class PlaceholderController extends Controller { public function index($Vp_i5, $bm5Bi) { goto GuqN7; lu_po: $VCmBY = Image::canvas($Vp_i5, $bm5Bi, '#CCC'); goto O4O6L; gHRLs: $Vp_i5 = max($Vp_i5, 10); goto MEApw; Uhwfv: $bm5Bi = max($bm5Bi, 10); goto lu_po; GuqN7: $Vp_i5 = min($Vp_i5, 2000); goto gHRLs; O4O6L: $VCmBY->text($Vp_i5 . 'x' . $bm5Bi, $Vp_i5 / 2, $bm5Bi / 2, function ($zXK_P) use($Vp_i5, $bm5Bi) { $xvDt0 = min($Vp_i5, $bm5Bi) / 10; $zXK_P->size($xvDt0); $zXK_P->color('#666666'); $zXK_P->align('center'); $zXK_P->valign('center'); }); goto oYu7c; MEApw: $bm5Bi = min($bm5Bi, 2000); goto Uhwfv; oYu7c: return Response::make($VCmBY->encode('png'))->header('Content-Type', 'image/png'); goto duypB; duypB: } }