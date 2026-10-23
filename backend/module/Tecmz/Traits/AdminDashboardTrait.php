<?php
/**
 * ------------------------ 
 *  版权所有  www.bygoukai.com
 *  商业版本请购买正版授权使用
 * ------------------------
*/ namespace Module\Tecmz\Traits; use ModStart\Admin\Layout\AdminPage; use ModStart\Admin\Widget\SecurityTooltipBox; use ModStart\Layout\Row; use Module\AdminManager\Widget\ServerInfoWidget; use Module\Tecmz\Widget\CopyrightWidget; use Module\Vendor\Admin\Config\AdminWidgetDashboard; trait AdminDashboardTrait { public function dashboard() { goto qNFvw; tuQe3: $QDBmO->pageTitle(L('Dashboard'))->row(new SecurityTooltipBox())->append(new Row(function (Row $kyXWS) { AdminWidgetDashboard::callTodo($kyXWS); }))->append(new Row(function (Row $kyXWS) { AdminWidgetDashboard::callIcon($kyXWS); })); goto ZgdZm; nf1eZ: return $QDBmO; goto C_8OA; qNFvw: $QDBmO = app(AdminPage::class); goto tuQe3; oaft3: $QDBmO->append(new ServerInfoWidget()); goto nf1eZ; ZgdZm: AdminWidgetDashboard::call($QDBmO); goto cVB86; cVB86: $QDBmO->append(new CopyrightWidget()); goto oaft3; C_8OA: } }