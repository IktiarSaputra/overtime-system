<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<h1 class="code-line" data-line-start=0 data-line-end=1 ><a id="Getting_started_0"></a>Getting started</h1>
<h2 class="code-line" data-line-start=2 data-line-end=3 ><a id="Installation_2"></a>Installation</h2>
<p class="has-line-data" data-line-start="4" data-line-end="5">Please check the official laravel installation guide for server requirements before you start. <a href="https://laravel.com/docs/8.x">Official Documentation</a></p>
<p class="has-line-data" data-line-start="6" data-line-end="7">Clone the repository</p>
<pre><code>git clone git@github.com:gothinkster/laravel-realworld-example-app.git
</code></pre>
<p class="has-line-data" data-line-start="10" data-line-end="11">Switch to the repo folder</p>
<pre><code>cd laravel-realworld-example-app
</code></pre>
<p class="has-line-data" data-line-start="14" data-line-end="15">Install all the dependencies using composer</p>
<pre><code>composer install
</code></pre>
<p class="has-line-data" data-line-start="18" data-line-end="19">Copy the example env file and make the required configuration changes in the .env file</p>
<pre><code>cp .env.example .env
</code></pre>
<p class="has-line-data" data-line-start="22" data-line-end="23">Generate a new application key</p>
<pre><code>php artisan key:generate
</code></pre>
<p class="has-line-data" data-line-start="26" data-line-end="27">Run the database migrations (<strong>Set the database connection in .env before migrating</strong>)</p>
<pre><code>php artisan migrate
</code></pre>
<p class="has-line-data" data-line-start="30" data-line-end="31">Run the database seeder</p>
<pre><code>php artisan db:seed
</code></pre>
<p class="has-line-data" data-line-start="34" data-line-end="35">Start the local development server</p>
<pre><code>php artisan serve
</code></pre>
<h2 class="code-line" data-line-start=38 data-line-end=39 ><a id="Testing_API_38"></a>Testing API</h2>
<p class="has-line-data" data-line-start="39" data-line-end="40">You can now access the server at <a href="http://localhost:8000/">http://localhost:8000/</a></p>
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><strong>Url</strong></th>
<th><strong>Parameter</strong></th>
<th><strong>Method</strong></th>
<th><strong>Description</strong></th>
</tr>
</thead>
<tbody>
<tr>
<td>/settings</td>
<td>-</td>
<td>application/json</td>
<td>Get All Settings</td>
</tr>
<tr>
<td>/settings</td>
<td>key , value</td>
<td>Patch</td>
<td>Update Setting</td>
</tr>
<tr>
<td>/employees</td>
<td>name , salary</td>
<td>Post</td>
<td>Store New Employee</td>
</tr>
<tr>
<td>/overtimes</td>
<td>employee_id , date , time_started, time_ended</td>
<td>Post</td>
<td>Store New Overtime</td>
</tr>
<tr>
<td>/overtime-pays/calculate</td>
<td>mount</td>
<td>Get</td>
<td>Get Overtime Pay Calculate</td>
</tr>
</tbody>
</table>
<h2 class="code-line" data-line-start=49 data-line-end=50 ><a id="Example_Request_49"></a>Example Request</h2>
<p class="has-line-data" data-line-start="50" data-line-end="51">Get All Setting</p>
<pre><code>curl -X 'GET' \
'http://127.0.0.1:8000/api/settings' \
-H 'accept: application/json' \
-H 'X-CSRF-TOKEN: '
</code></pre>
<p class="has-line-data" data-line-start="57" data-line-end="58">Update Setting</p>
<pre><code>curl -X 'PATCH' \
  'http://127.0.0.1:8000/api/settings' \
  -H 'accept: */*' \
  -H 'Content-Type: application/json' \
  -H 'X-CSRF-TOKEN: ' \
  -d '{
  &quot;key&quot;: &quot;overtime_method&quot;,
  &quot;value&quot;: &quot;1&quot;
}'
</code></pre>
<p class="has-line-data" data-line-start="69" data-line-end="70">Create New Employee</p>
<pre><code>curl -X 'POST' \
  'http://127.0.0.1:8000/api/employees' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -H 'X-CSRF-TOKEN: ' \
  -d '{
  &quot;name&quot;: &quot;Budi&quot;,
  &quot;salary&quot;: 4500000
}'
</code></pre>
<p class="has-line-data" data-line-start="81" data-line-end="82">Create New Overtime</p>
<pre><code>curl -X 'POST' \
  'http://127.0.0.1:8000/api/overtimes' \
  -H 'accept: application/json' \
  -H 'Content-Type: application/json' \
  -H 'X-CSRF-TOKEN: ' \
  -d '{
  &quot;employee_id&quot;: 1,
  &quot;date&quot;: &quot;2022-07-10&quot;,
  &quot;time_start&quot;: &quot;07:00&quot;,
  &quot;time_ended&quot;: &quot;17:00&quot;
}'
</code></pre>
<p class="has-line-data" data-line-start="95" data-line-end="96">Get Overtime Pays</p>
<pre><code>curl -X 'GET' \
    'http://127.0.0.1:8000/api/overtime-pays/calculate?mount=2022-07' \
    -H 'accept: application/json' \
    -H 'X-CSRF-TOKEN: '
</code></pre>
