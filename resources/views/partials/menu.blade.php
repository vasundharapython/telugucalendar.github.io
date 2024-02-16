<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('day_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.days.index") }}" class="nav-link {{ request()->is("admin/days") || request()->is("admin/days/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.day.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('nelalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.nelalus.index") }}" class="nav-link {{ request()->is("admin/nelalus") || request()->is("admin/nelalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Nelalu') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                @can('month_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.months.index") }}" class="nav-link {{ request()->is("admin/months") || request()->is("admin/months/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.month.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/content-categories*") ? "menu-open" : "" }} {{ request()->is("admin/content-tags*") ? "menu-open" : "" }} {{ request()->is("admin/content-pages*") ? "menu-open" : "" }} {{ request()->is("admin/bhagavathgeethas*") ? "menu-open" : "" }} {{ request()->is("admin/bhakthigeetams*") ? "menu-open" : "" }} {{ request()->is("admin/kathalus*") ? "menu-open" : "" }} {{ request()->is("admin/pujalus*") ? "menu-open" : "" }} {{ request()->is("admin/puranalus*") ? "menu-open" : "" }} {{ request()->is("admin/vrathalus*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/content-categories*") ? "active" : "" }} {{ request()->is("admin/content-tags*") ? "active" : "" }} {{ request()->is("admin/content-pages*") ? "active" : "" }} {{ request()->is("admin/bhagavathgeethas*") ? "active" : "" }} {{ request()->is("admin/bhakthigeetams*") ? "active" : "" }} {{ request()->is("admin/kathalus*") ? "active" : "" }} {{ request()->is("admin/pujalus*") ? "active" : "" }} {{ request()->is("admin/puranalus*") ? "active" : "" }} {{ request()->is("admin/vrathalus*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            {{--@can('bhagavathgeetha_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.bhagavathgeethas.index") }}" class="nav-link {{ request()->is("admin/bhagavathgeethas") || request()->is("admin/bhagavathgeethas/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bhagavathgeetha.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan--}}
                            @can('bhakthi_geetha_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.bhakthi-geetha-categories.index") }}" class="nav-link {{ request()->is("admin/bhakthi-geetha-categories") || request()->is("admin/bhakthi-geetha-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('BhakthiGeethaCategories') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('bhakthigeetam_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.bhakthigeetams.index") }}" class="nav-link {{ request()->is("admin/bhakthigeetams") || request()->is("admin/bhakthigeetams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.bhakthigeetam.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            {{--@can('kathalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.kathalus.index") }}" class="nav-link {{ request()->is("admin/kathalus") || request()->is("admin/kathalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.kathalu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan--}}
                            {{--@can('pujalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.pujalus.index") }}" class="nav-link {{ request()->is("admin/pujalus") || request()->is("admin/pujalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pujalu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan--}}
                            {{--@can('puranalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.puranalus.index") }}" class="nav-link {{ request()->is("admin/puranalus") || request()->is("admin/puranalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.puranalu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan--}}
                            {{--@can('vrathalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vrathalus.index") }}" class="nav-link {{ request()->is("admin/vrathalus") || request()->is("admin/vrathalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.vrathalu.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan--}}
                            @can('muhurthalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.muhurthalus.index") }}" class="nav-link {{ request()->is("admin/muhurthalus") || request()->is("admin/muhurthalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Muhurthalu') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sthotralu_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sthotralu-categories.index") }}" class="nav-link {{ request()->is("admin/sthotralu-categories") || request()->is("admin/sthotralu-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-center">

                                        </i>
                                        <p>
                                            {{ trans('SthotraluCategory') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sthothralu_sub_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sthothralu-sub-categories.index") }}" class="nav-link {{ request()->is("admin/sthothralu-sub-categories") || request()->is("admin/sthothralu-sub-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-center">

                                        </i>
                                        <p>
                                            {{ trans('SthothraluSubCategory') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sthotralu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sthotralus.index") }}" class="nav-link {{ request()->is("admin/sthotralus") || request()->is("admin/sthotralus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Sthotralu') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sankalpalu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sankalpalus.index") }}" class="nav-link {{ request()->is("admin/sankalpalus") || request()->is("admin/sankalpalus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Sankalpalu') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sankatahari_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sankataharis.index") }}" class="nav-link {{ request()->is("admin/sankataharis") || request()->is("admin/sankataharis/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Sankatahari') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('ekadasi_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.ekadasis.index") }}" class="nav-link {{ request()->is("admin/ekadasis") || request()->is("admin/ekadasis/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Ekadasi') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('scategory_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.scategories.index") }}" class="nav-link {{ request()->is("admin/scategories") || request()->is("admin/scategories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Anubandham Category') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('ssub_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.ssub-categories.index") }}" class="nav-link {{ request()->is("admin/ssub-categories") || request()->is("admin/ssub-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Anubandham SubCategory') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sthothralu_copy_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sthothralu-copies.index") }}" class="nav-link {{ request()->is("admin/sthothralu-copies") || request()->is("admin/sthothralu-copies/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Anubandham') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vedasukthulu_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vedasukthulu-categories.index") }}" class="nav-link {{ request()->is("admin/vedasukthulu-categories") || request()->is("admin/vedasukthulu-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('VedasukthuluCategory') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vedasukthulu_sub_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vedasukthulu-sub-categories.index") }}" class="nav-link {{ request()->is("admin/vedasukthulu-sub-categories") || request()->is("admin/vedasukthulu-sub-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('VedasukthuluSubCategory') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vedasukthulu_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vedasukthulus.index") }}" class="nav-link {{ request()->is("admin/vedasukthulus") || request()->is("admin/vedasukthulus/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Vedasukthulu') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('gallery_access')
                                <li class="nav-item">
                                    <a href="{{ route("gallery.index") }}" class="nav-link {{ request()->is("admin/gallery") || request()->is("admin/gallery/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-center">

                                        </i>
                                        <p>
                                            {{ trans('Gallery') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('gallery_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.popup.index") }}" class="nav-link {{ request()->is("admin/popup") || request()->is("admin/popup/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-align-center">

                                        </i>
                                        <p>
                                            {{ trans('PopUp') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('blog_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.blog-categories.index") }}" class="nav-link {{ request()->is("admin/blog-categories") || request()->is("admin/blog-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('BlogCategory') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('blog_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.blogs.index") }}" class="nav-link {{ request()->is("admin/blogs") || request()->is("admin/blogs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Blog') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('service_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/puja-bookings*") ? "menu-open" : "" }} {{ request()->is("admin/muhurthambookings*") ? "menu-open" : "" }} {{ request()->is("admin/horoscopedetails*") ? "menu-open" : "" }} {{ request()->is("admin/onlinepujadetails*") ? "menu-open" : "" }} {{ request()->is("admin/vedas-details*") ? "menu-open" : "" }} {{ request()->is("admin/donation-details*") ? "menu-open" : "" }} {{ request()->is("admin/godanam-details*") ? "menu-open" : "" }} {{ request()->is("admin/seva-details*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/puja-bookings*") ? "active" : "" }} {{ request()->is("admin/muhurthambookings*") ? "active" : "" }} {{ request()->is("admin/horoscopedetails*") ? "active" : "" }} {{ request()->is("admin/onlinepujadetails*") ? "active" : "" }} {{ request()->is("admin/vedas-details*") ? "active" : "" }} {{ request()->is("admin/donation-details*") ? "active" : "" }} {{ request()->is("admin/godanam-details*") ? "active" : "" }} {{ request()->is("admin/seva-details*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.service.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('puja_booking_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.puja-bookings.index") }}" class="nav-link {{ request()->is("admin/puja-bookings") || request()->is("admin/puja-bookings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.pujaBooking.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('muhurthambooking_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.muhurthambookings.index") }}" class="nav-link {{ request()->is("admin/muhurthambookings") || request()->is("admin/muhurthambookings/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.muhurthambooking.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('horoscopedetail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.horoscopedetails.index") }}" class="nav-link {{ request()->is("admin/horoscopedetails") || request()->is("admin/horoscopedetails/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.horoscopedetail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('onlinepujadetail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.onlinepujadetails.index") }}" class="nav-link {{ request()->is("admin/onlinepujadetails") || request()->is("admin/onlinepujadetails/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.onlinepujadetail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('vedas_detail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.vedas-details.index") }}" class="nav-link {{ request()->is("admin/vedas-details") || request()->is("admin/vedas-details/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.vedasDetail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('donation_detail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.donation-details.index") }}" class="nav-link {{ request()->is("admin/donation-details") || request()->is("admin/donation-details/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.donationDetail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('annadanam_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.annadanams.index") }}" class="nav-link {{ request()->is("admin/annadanams") || request()->is("admin/annadanams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('Annadanam') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('godanam_detail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.godanam-details.index") }}" class="nav-link {{ request()->is("admin/godanam-details") || request()->is("admin/godanam-details/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.godanamDetail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('seva_detail_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.seva-details.index") }}" class="nav-link {{ request()->is("admin/seva-details") || request()->is("admin/seva-details/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.sevaDetail.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('job_portal_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/job-categories*") ? "menu-open" : "" }} {{ request()->is("admin/job-roles*") ? "menu-open" : "" }} {{ request()->is("admin/job-creations*") ? "menu-open" : "" }} {{ request()->is("admin/job-applications*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/job-categories*") ? "active" : "" }} {{ request()->is("admin/job-roles*") ? "active" : "" }} {{ request()->is("admin/job-creations*") ? "active" : "" }} {{ request()->is("admin/job-applications*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.jobPortal.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('job_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.job-categories.index") }}" class="nav-link {{ request()->is("admin/job-categories") || request()->is("admin/job-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jobCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('job_role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.job-roles.index") }}" class="nav-link {{ request()->is("admin/job-roles") || request()->is("admin/job-roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jobRole.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('job_creation_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.job-creations.index") }}" class="nav-link {{ request()->is("admin/job-creations") || request()->is("admin/job-creations/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jobCreation.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('job_application_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.job-applications.index") }}" class="nav-link {{ request()->is("admin/job-applications") || request()->is("admin/job-applications/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.jobApplication.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('month_mi_access')
                <li class="nav-item">
                    <a href="{{ route("event.index") }}" class="nav-link {{ request()->is("admin/event") || request()->is("admin/event/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('cruds.monthMi.title') }}
                        </p>
                    </a>
                </li>
            @endcan
            @can('add_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.adds.index") }}" class="nav-link {{ request()->is("admin/adds") || request()->is("admin/adds/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-location-arrow">

                            </i>
                            <p>
                                {{ trans('Adds') }}
                            </p>
                        </a>
                    </li>
                @endcan
            @can('month_mi_access')
                <li class="nav-item">
                    <a href="{{ route("gallery.index") }}" class="nav-link {{ request()->is("admin/gallery") || request()->is("admin/gallery/*") ? "active" : "" }}">
                        <i class="fa-fw nav-icon fas fa-cogs">

                        </i>
                        <p>
                            {{ trans('Gallery') }}
                        </p>
                    </a>
                </li>
            @endcan
                @can('basic_c_r_m_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/crm-statuses*") ? "menu-open" : "" }} {{ request()->is("admin/crm-customers*") ? "menu-open" : "" }} {{ request()->is("admin/crm-notes*") ? "menu-open" : "" }} {{ request()->is("admin/crm-documents*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/crm-statuses*") ? "active" : "" }} {{ request()->is("admin/crm-customers*") ? "active" : "" }} {{ request()->is("admin/crm-notes*") ? "active" : "" }} {{ request()->is("admin/crm-documents*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-briefcase">

                            </i>
                            <p>
                                {{ trans('cruds.basicCRM.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('crm_status_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-statuses.index") }}" class="nav-link {{ request()->is("admin/crm-statuses") || request()->is("admin/crm-statuses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmStatus.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_customer_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-customers.index") }}" class="nav-link {{ request()->is("admin/crm-customers") || request()->is("admin/crm-customers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-plus">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmCustomer.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_note_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-notes.index") }}" class="nav-link {{ request()->is("admin/crm-notes") || request()->is("admin/crm-notes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-sticky-note">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmNote.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('crm_document_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.crm-documents.index") }}" class="nav-link {{ request()->is("admin/crm-documents") || request()->is("admin/crm-documents/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.crmDocument.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
