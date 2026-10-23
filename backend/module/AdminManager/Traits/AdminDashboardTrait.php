<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\AdminManager\Traits; use ModStart\Admin\Layout\AdminPage; use ModStart\Admin\Widget\SecurityTooltipBox; use ModStart\Layout\Row; use Module\AdminManager\Widget\ServerInfoWidget; use Module\Vendor\Admin\Config\AdminWidgetDashboard; trait AdminDashboardTrait { public function dashboard() { goto VQVzt; Cimd4: AdminWidgetDashboard::call($QDBmO); goto OHPhH; K1Rxr: return $QDBmO; goto Z8thg; RU8Rs: $QDBmO->pageTitle(L('Dashboard'))->row(new SecurityTooltipBox())->append(new Row(function (Row $kyXWS) { AdminWidgetDashboard::callIcon($kyXWS); })); goto Cimd4; OHPhH: $QDBmO->append(new ServerInfoWidget()); goto K1Rxr; VQVzt: $QDBmO = app(AdminPage::class); goto RU8Rs; Z8thg: } }