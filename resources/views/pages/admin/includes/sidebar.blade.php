<div class="list-group bg-dark">
    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.dashboard" ? "active" : "" }}" aria-current="true">Dashboard</a>
    <a href="{{ route('admin.predictions', ['type' => 'active']) }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.predictions" ? "active" : "" }}">Bet Predictions</a>
    <a href="{{ route('admin.bet-groups', ['type' => 'active']) }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.bet-groups" ? "active" : "" }}">Bet Groups</a>
    <a href="{{ route('admin.subscriptions', ['type' => 'active']) }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.subscriptions" ? "active" : "" }}">Bet Subscriptions</a>
    <a href="{{ route('admin.sms-subscriptions', ['type' => 'active']) }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.sms-subscriptions" ? "active" : "" }}">SMS Subscriptions</a>
    <a href="{{ route('admin.transactions', ['type' => 'all']) }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.transactions" ? "active" : "" }}">Transactions</a>
    <a href="{{ route('admin.users', ['type' => 'active']) }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.users" ? "active" : "" }}">Users</a>
    <a href="{{ route('admin.site-settings') }}" class="list-group-item list-group-item-action list-group-item-dark {{ isset($nav) && $nav == "admin.site-settings" ? "active" : "" }}">Site Settings</a>
    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action list-group-item-dark">Logout</a>
    
</div>
