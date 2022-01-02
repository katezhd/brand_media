# Authors

API для работы с авторами.

## List of Authors




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/authors?page=14&sort=alias&search=quae&status=sunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/authors"
);

let params = {
    "page": "14",
    "sort": "alias",
    "search": "quae",
    "status": "sunt",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```
<div id="execution-results-GETapi-v1-authors" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-authors"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-authors"></code></pre>
</div>
<div id="execution-error-GETapi-v1-authors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-authors"></code></pre>
</div>
<form id="form-GETapi-v1-authors" data-method="GET" data-path="api/v1/authors" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-authors', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-authors" onclick="tryItOut('GETapi-v1-authors');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-authors" onclick="cancelTryOut('GETapi-v1-authors');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-authors" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/authors</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-authors" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-authors" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-authors" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-authors" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified Authors




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/author/voluptatem" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/author/voluptatem"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```
<div id="execution-results-GETapi-v1-author--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-author--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-author--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-author--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-author--id-"></code></pre>
</div>
<form id="form-GETapi-v1-author--id-" data-method="GET" data-path="api/v1/author/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-author--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-author--id-" onclick="tryItOut('GETapi-v1-author--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-author--id-" onclick="cancelTryOut('GETapi-v1-author--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-author--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/author/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-author--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## Create Authors

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://brand_media.test/api/v1/author" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"firstname":"impedit","lastname":"aut","meta_title":"suscipit","meta_description":"amet","image":"dolor","image_delete":"omnis","status":2}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/author"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "firstname": "impedit",
    "lastname": "aut",
    "meta_title": "suscipit",
    "meta_description": "amet",
    "image": "dolor",
    "image_delete": "omnis",
    "status": 2
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-author" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-author"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-author"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-author" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-author"></code></pre>
</div>
<form id="form-POSTapi-v1-author" data-method="POST" data-path="api/v1/author" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-author', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-author" onclick="tryItOut('POSTapi-v1-author');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-author" onclick="cancelTryOut('POSTapi-v1-author');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-author" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/author</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-author" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-author" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>firstname</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="firstname" data-endpoint="POSTapi-v1-author" data-component="body" required  hidden>
<br>
Имя
</p>
<p>
<b><code>lastname</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="lastname" data-endpoint="POSTapi-v1-author" data-component="body" required  hidden>
<br>
Фамилия
</p>
<p>
<b><code>meta_title</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_title" data-endpoint="POSTapi-v1-author" data-component="body" required  hidden>
<br>
Тег title
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="meta_description" data-endpoint="POSTapi-v1-author" data-component="body" required  hidden>
<br>
Тег description
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="POSTapi-v1-author" data-component="body"  hidden>
<br>
Картинка
</p>
<p>
<b><code>image_delete</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image_delete" data-endpoint="POSTapi-v1-author" data-component="body"  hidden>
<br>
Удаление картинки (1-удалить)
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="POSTapi-v1-author" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Update Authors

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X PUT \
    "http://brand_media.test/api/v1/author/nobis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"firstname":"eius","lastname":"vel","meta_title":"est","meta_description":"provident","image":"aperiam","image_delete":"ab","status":3}'

```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/author/nobis"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "firstname": "eius",
    "lastname": "vel",
    "meta_title": "est",
    "meta_description": "provident",
    "image": "aperiam",
    "image_delete": "ab",
    "status": 3
}

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-PUTapi-v1-author--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-PUTapi-v1-author--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-v1-author--id-"></code></pre>
</div>
<div id="execution-error-PUTapi-v1-author--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-v1-author--id-"></code></pre>
</div>
<form id="form-PUTapi-v1-author--id-" data-method="PUT" data-path="api/v1/author/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('PUTapi-v1-author--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-PUTapi-v1-author--id-" onclick="tryItOut('PUTapi-v1-author--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-PUTapi-v1-author--id-" onclick="cancelTryOut('PUTapi-v1-author--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-PUTapi-v1-author--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-darkblue">PUT</small>
 <b><code>api/v1/author/{id}</code></b>
</p>
<p>
<label id="auth-PUTapi-v1-author--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="PUTapi-v1-author--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="PUTapi-v1-author--id-" data-component="url" required  hidden>
<br>

</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>firstname</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="firstname" data-endpoint="PUTapi-v1-author--id-" data-component="body" required  hidden>
<br>
Имя
</p>
<p>
<b><code>lastname</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="lastname" data-endpoint="PUTapi-v1-author--id-" data-component="body" required  hidden>
<br>
Фамилия
</p>
<p>
<b><code>meta_title</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta_title" data-endpoint="PUTapi-v1-author--id-" data-component="body"  hidden>
<br>
Тег title
</p>
<p>
<b><code>meta_description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="meta_description" data-endpoint="PUTapi-v1-author--id-" data-component="body"  hidden>
<br>
Тег description
</p>
<p>
<b><code>image</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image" data-endpoint="PUTapi-v1-author--id-" data-component="body"  hidden>
<br>
Картинка
</p>
<p>
<b><code>image_delete</code></b>&nbsp;&nbsp;<small>optional</small>     <i>optional</i> &nbsp;
<input type="text" name="image_delete" data-endpoint="PUTapi-v1-author--id-" data-component="body"  hidden>
<br>
Удаление картинки (1-удалить)
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="status" data-endpoint="PUTapi-v1-author--id-" data-component="body"  hidden>
<br>
Статус отображения (1-отображается, 0-скрыто)
</p>

</form>


## Delete specified Authors

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X DELETE \
    "http://brand_media.test/api/v1/author/culpa" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/author/culpa"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response => response.json());
```


<div id="execution-results-DELETEapi-v1-author--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-DELETEapi-v1-author--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-v1-author--id-"></code></pre>
</div>
<div id="execution-error-DELETEapi-v1-author--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-v1-author--id-"></code></pre>
</div>
<form id="form-DELETEapi-v1-author--id-" data-method="DELETE" data-path="api/v1/author/{id}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('DELETEapi-v1-author--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-DELETEapi-v1-author--id-" onclick="tryItOut('DELETEapi-v1-author--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-DELETEapi-v1-author--id-" onclick="cancelTryOut('DELETEapi-v1-author--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-DELETEapi-v1-author--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-red">DELETE</small>
 <b><code>api/v1/author/{id}</code></b>
</p>
<p>
<label id="auth-DELETEapi-v1-author--id-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="DELETEapi-v1-author--id-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="DELETEapi-v1-author--id-" data-component="url" required  hidden>
<br>

</p>
</form>


## List of Authors




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/app/authors?page=18&sort=voluptas&search=ad&status=in" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/authors"
);

let params = {
    "page": "18",
    "sort": "voluptas",
    "search": "ad",
    "status": "in",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (500):

```json
{
    "message": "SQLSTATE[42S22]: Column not found: 1054 Unknown column 'name' in 'where clause' (SQL: select count(*) as aggregate from `authors` where `name` LIKE %ad% and `authors`.`deleted_at` is null)",
    "exception": "Illuminate\\Database\\QueryException",
    "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Connection.php",
    "line": 703,
    "trace": [
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Connection.php",
            "line": 663,
            "function": "runQueryCallback",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Connection.php",
            "line": 367,
            "function": "run",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Query\/Builder.php",
            "line": 2351,
            "function": "select",
            "class": "Illuminate\\Database\\Connection",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Query\/Builder.php",
            "line": 2339,
            "function": "runSelect",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Query\/Builder.php",
            "line": 2873,
            "function": "Illuminate\\Database\\Query\\{closure}",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Query\/Builder.php",
            "line": 2340,
            "function": "onceWithColumns",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Query\/Builder.php",
            "line": 2487,
            "function": "get",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Query\/Builder.php",
            "line": 2446,
            "function": "runPaginationCountQuery",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Database\/Eloquent\/Builder.php",
            "line": 798,
            "function": "getCountForPagination",
            "class": "Illuminate\\Database\\Query\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/app\/Models\/Author.php",
            "line": 107,
            "function": "paginate",
            "class": "Illuminate\\Database\\Eloquent\\Builder",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/app\/Http\/Controllers\/AuthorController.php",
            "line": 35,
            "function": "getAll",
            "class": "App\\Models\\Author",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Controller.php",
            "line": 54,
            "function": "index",
            "class": "App\\Http\\Controllers\\AuthorController",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/ControllerDispatcher.php",
            "line": 45,
            "function": "callAction",
            "class": "Illuminate\\Routing\\Controller",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php",
            "line": 262,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\ControllerDispatcher",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Route.php",
            "line": 205,
            "function": "runController",
            "class": "Illuminate\\Routing\\Route",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 695,
            "function": "run",
            "class": "Illuminate\\Routing\\Route",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 128,
            "function": "Illuminate\\Routing\\{closure}",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/SubstituteBindings.php",
            "line": 50,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\SubstituteBindings",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 697,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 672,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 625,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 167,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 128,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ConvertEmptyStringsToNull.php",
            "line": 31,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ConvertEmptyStringsToNull",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TrimStrings.php",
            "line": 40,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TrimStrings",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/PreventRequestsDuringMaintenance.php",
            "line": 86,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/fruitcake\/laravel-cors\/src\/HandleCors.php",
            "line": 52,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Fruitcake\\Cors\\HandleCors",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Http\/Middleware\/TrustProxies.php",
            "line": 39,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Http\\Middleware\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 142,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 111,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 324,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 305,
            "function": "callLaravelOrLumenRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 76,
            "function": "makeApiCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 51,
            "function": "makeResponseCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 41,
            "function": "makeResponseCallIfEnabledAndNoSuccessResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 236,
            "function": "__invoke",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 172,
            "function": "iterateThroughStrategies",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 127,
            "function": "fetchResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 119,
            "function": "processRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 73,
            "function": "processRoutes",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 36,
            "function": "handle",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Util.php",
            "line": 40,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 93,
            "function": "unwrapIfClosure",
            "class": "Illuminate\\Container\\Util",
            "type": "::"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 37,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 653,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 136,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 299,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 121,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/symfony\/console\/Application.php",
            "line": 978,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/symfony\/console\/Application.php",
            "line": 295,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/symfony\/console\/Application.php",
            "line": 167,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 94,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 129,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/katherine\/www\/brand_media\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```
<div id="execution-results-GETapi-v1-app-authors" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-authors"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-authors"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-authors" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-authors"></code></pre>
</div>
<form id="form-GETapi-v1-app-authors" data-method="GET" data-path="api/v1/app/authors" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-authors', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-authors" onclick="tryItOut('GETapi-v1-app-authors');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-authors" onclick="cancelTryOut('GETapi-v1-app-authors');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-authors" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/authors</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>integer</small>     <i>optional</i> &nbsp;
<input type="number" name="page" data-endpoint="GETapi-v1-app-authors" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-app-authors" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию  'id|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-app-authors" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>status</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="status" data-endpoint="GETapi-v1-app-authors" data-component="query"  hidden>
<br>
Статус отображения (возможные значения visible, hidden)
</p>
</form>


## Get specified Authors




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/app/author/est" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/author/est"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (404):

```json
{
    "status": "error",
    "message": "Ресурс не знайден."
}
```
<div id="execution-results-GETapi-v1-app-author--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-author--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-author--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-author--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-author--id-"></code></pre>
</div>
<form id="form-GETapi-v1-app-author--id-" data-method="GET" data-path="api/v1/app/author/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-author--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-author--id-" onclick="tryItOut('GETapi-v1-app-author--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-author--id-" onclick="cancelTryOut('GETapi-v1-app-author--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-author--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/author/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-app-author--id-" data-component="url" required  hidden>
<br>

</p>
</form>



