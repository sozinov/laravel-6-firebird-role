<h2>Firebird database driver for Laravel 6&nbsp;with role in dsn</h2>
<p>Based on Package <a href="https://github.com/KKSzymanowski/laravel-6-firebird.git">KKSzymanowski/laravel-6-firebird</a></p>
<h3><a id="user-content-installation" class="anchor" href="https://github.com/KKSzymanowski/laravel-6-firebird#installation" aria-hidden="true"></a>Installation</h3>
<pre><code>composer require kkszymanowski/laravel-6-firebird
</code></pre>
<p>Add you database configuration in&nbsp;<code>config/database.php</code></p>
<div class="highlight highlight-text-html-php">
<pre><span class="pl-s">'connections'</span> =&gt; [
    <span class="pl-s">'myFirebirdConnection'</span> =&gt; [
        <span class="pl-s">'driver'</span>=&gt; <span class="pl-s">'firebird'</span>,
        <span class="pl-s">'host'</span>=&gt; <span class="pl-en">env</span>(<span class="pl-s">'DB_FIREBIRD_HOST'</span>, <span class="pl-s">'localhost'</span>),
        <span class="pl-s">'database'</span> =&gt; <span class="pl-en">env</span>(<span class="pl-s">'DB_FIREBIRD_DATABASE'</span>, <span class="pl-s">'/path_to/database.fdb'</span>),
        <span class="pl-s">'username'</span> =&gt; <span class="pl-en">env</span>(<span class="pl-s">'DB_FIREBIRD_USERNAME'</span>, <span class="pl-s">'SYSDBA'</span>),
        <span class="pl-s">'password'</span> =&gt; <span class="pl-en">env</span>(<span class="pl-s">'DB_FIREBIRD_PASSWORD'</span>, <span class="pl-s">'masterkey'</span>),
        <span class="pl-s">'charset'</span> =&gt; <span class="pl-en">env</span>(<span class="pl-s">'DB_FIREBIRD_CHARSET'</span>, <span class="pl-s">'UTF8'</span>),<br />        'role' =&gt; env('DB_FIREBIRD_ROLE', ''),&nbsp;
    ],

    <span class="pl-c">// ...</span>
],</pre>
</div>
<p>Add the&nbsp;<code>DB_FIREBIRD_*</code>&nbsp;environment variables to you&nbsp;<code>.env</code>&nbsp;file, for example:</p>
<pre><code>DB_FIREBIRD_HOST=192.168.0.1
DB_FIREBIRD_DATABASE=C:/DB.FDB
DB_FIREBIRD_USERNAME=user
DB_FIREBIRD_PASSWORD=password
DB_FIREBIRD_CHARSET=ISO-8859-2
DB_FIREBIRD_ROLE=''&nbsp;</code></pre>
<h3><a id="user-content-usage" class="anchor" href="https://github.com/KKSzymanowski/laravel-6-firebird#usage" aria-hidden="true"></a>Usage</h3>
<h4><a id="user-content-eloquent-as-model" class="anchor" href="https://github.com/KKSzymanowski/laravel-6-firebird#eloquent-as-model" aria-hidden="true"></a>Eloquent as model</h4>
<p>To override your default database connection define&nbsp;<code>$connection</code>&nbsp;name in your Eloquent Model</p>
<div class="highlight highlight-text-html-php">
<pre><span class="pl-c">/**</span>
<span class="pl-c"> * The connection name for the model.</span>
<span class="pl-c"> *</span>
<span class="pl-c"> * @var string</span>
<span class="pl-c"> */</span>
<span class="pl-k">protected</span> <span class="pl-s1"><span class="pl-c1">$</span>connection</span> = <span class="pl-s">'myFirebirdConnection'</span>;</pre>
</div>
<p>After defining connection name you can use it in normal way as you use Eloquent:</p>
<div class="highlight highlight-text-html-php">
<pre><span class="pl-s1"><span class="pl-c1">$</span>user</span> = <span class="pl-v">User</span>::<span class="pl-en">where</span>(<span class="pl-s">'id'</span>, <span class="pl-c1">1</span>)-&gt;<span class="pl-en">get</span>();

<span class="pl-s1"><span class="pl-c1">$</span>users</span> = <span class="pl-v">User</span>::<span class="pl-en">all</span>();</pre>
</div>
<h4><a id="user-content-db-query" class="anchor" href="https://github.com/KKSzymanowski/laravel-6-firebird#db-query" aria-hidden="true"></a>DB Query</h4>
<p>Each time you have to define connecion name (if it isn't your default one), for example:</p>
<div class="highlight highlight-text-html-php">
<pre><span class="pl-s1"><span class="pl-c1">$</span>sql</span> = <span class="pl-s">'SELECT * FROM USERS WHERE id = :id'</span>;
<span class="pl-s1"><span class="pl-c1">$</span>bindings</span> = [<span class="pl-s">'id'</span> =&gt; <span class="pl-c1">1</span>];
<span class="pl-s1"><span class="pl-c1">$</span>user</span> = <span class="pl-c1">DB</span>::<span class="pl-en">connection</span>(<span class="pl-s">'myFirebirdConnection'</span>)-&gt;<span class="pl-en">select</span>(<span class="pl-s1"><span class="pl-c1">$</span>sql</span>, <span class="pl-s1"><span class="pl-c1">$</span>bindings</span>);

<span class="pl-s1"><span class="pl-c1">$</span>users</span> = <span class="pl-c1">DB</span>::<span class="pl-en">connection</span>(<span class="pl-s">'myFirebirdConnection'</span>)-&gt;<span class="pl-en">table</span>(<span class="pl-s">'USERS'</span>)-&gt;<span class="pl-en">select</span>(<span class="pl-s">'*'</span>)-&gt;<span class="pl-en">get</span>();</pre>
</div>
