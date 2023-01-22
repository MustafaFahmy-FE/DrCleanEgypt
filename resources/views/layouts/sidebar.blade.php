<aside>
    <button class="toggle-btn custom-btn">
        <i class="fa fa-times"></i>
    </button>
    <h3 class="logo">
        <img src="{{ asset('public/images/logo.png') }}" />

        {{ auth()->user()->name }}
    </h3>
    <ul>
        <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> الرئيسية </a>
        </li>
        <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
            <a href="{{ route('categories.index') }}"><i class="fa fa-info"></i> الأقسام <span>
                    {{ $category_counter }} </span>
            </a>
        </li>
        <li class="{{ request()->routeIs('items.index') ? 'active' : '' }}">
            <a href="{{ route('items.index') }}"><i class="far fa-bookmark"></i> الأصناف <span> {{ $item_counter }}
                </span>
            </a>
        </li>
        <li
            class="{{ request()->routeIs('orders.index') || request()->routeIs('orders.edit') || request()->routeIs('orders.print') || request()->routeIs('orders.show') || request()->routeIs('orders.create') ? 'active' : '' }}">
            <a href="{{ route('orders.index') }}"><i class="fa fa-list"></i> الطلبات <span>
                    {{ $order_undone_counter }}
                </span>
            </a>
        </li>
        <li class="{{ request()->routeIs('orders.archive') ? 'active' : '' }}">
            <a href="{{ route('orders.archive') }}"><i class="fa fa-list"></i> الارشيف <span>
                    {{ $order_done_counter }}
                </span>
            </a>
        </li>
        <li class="{{ request()->routeIs('clients.index') || request()->routeIs('clients.show') ? 'active' : '' }}">
            <a href="{{ route('clients.index') }}"><i class="fa fa-users"></i> العملاء <span>
                    {{ $client_counter }}
                </span>
            </a>
        </li>
        @if (auth()->user()->role == 'admin')
            <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}"><i class="fa fa-cog"></i> المستخدمين <span>
                        {{ $user_counter }}
                    </span>
                </a>
            </li>
            <li class="{{ request()->routeIs('employees.index') ? 'active' : '' }}">
                <a href="{{ route('employees.index') }}"><i class="fa fa-users"></i> الموظفين <span>
                        {{ $employee_counter }}
                    </span>
                </a>
            </li>
        @endif
        <li class="{{ request()->routeIs('reports') ? 'active' : '' }}">
            <a href="{{ route('reports') }}"><i class="far fa-file"></i> تقارير المبيعات </a>
        </li>
        <li class="{{ request()->routeIs('reports.report') ? 'active' : '' }}">
            <a href="{{ route('reports.report') }}"><i class="far fa-file"></i> تقارير الكي والغسيل </a>
        </li>
        <li class="{{ request()->routeIs('expenses.index') ? 'active' : '' }}">
            <a href="{{ route('expenses.index') }}"><i class="fas fa-dollar-sign"></i> المصروفات </a>
        </li>
        <li class="{{ request()->routeIs('attendance.index') ? 'active' : '' }}">
            <a href="{{ route('attendance.index') }}"><i class="fas fa-clipboard"></i> الحضور والانصراف</a>
        </li>
    </ul>
</aside>
