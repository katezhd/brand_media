# Activity Log

API для работы с историей действий пользователя в админке
Будет использоваться в админ панели сервиса

## List of activities




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/activitylogs?page=eum&sort=repudiandae&search=natus&subject_id=voluptatem&subject_type=iste&description=alias&causer_id=ab&from=minima&till=porro" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/activitylogs"
);

let params = {
    "page": "eum",
    "sort": "repudiandae",
    "search": "natus",
    "subject_id": "voluptatem",
    "subject_type": "iste",
    "description": "alias",
    "causer_id": "ab",
    "from": "minima",
    "till": "porro",
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
<div id="execution-results-GETapi-v1-activitylogs" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-activitylogs"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-activitylogs"></code></pre>
</div>
<div id="execution-error-GETapi-v1-activitylogs" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-activitylogs"></code></pre>
</div>
<form id="form-GETapi-v1-activitylogs" data-method="GET" data-path="api/v1/activitylogs" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-activitylogs', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-activitylogs" onclick="tryItOut('GETapi-v1-activitylogs');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-activitylogs" onclick="cancelTryOut('GETapi-v1-activitylogs');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-activitylogs" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/activitylogs</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
<p>
<b><code>page</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="page" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Номер страницы с результатами выдачи
</p>
<p>
<b><code>sort</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="sort" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Поле для сортировки. По-умолчанию 'id\|desc'
</p>
<p>
<b><code>search</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="search" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Строка, которая должна содержаться в результатах выдачи
</p>
<p>
<b><code>subject_id</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="subject_id" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
ID записи
</p>
<p>
<b><code>subject_type</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="subject_type" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Название раздела
</p>
<p>
<b><code>description</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="description" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Тип действия
</p>
<p>
<b><code>causer_id</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="causer_id" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Кто делал
</p>
<p>
<b><code>from</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="from" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Дата начала интервала результатов выдачи (в формате 'DD-MM-YYYY HH:mm:ss')
</p>
<p>
<b><code>till</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="till" data-endpoint="GETapi-v1-activitylogs" data-component="query"  hidden>
<br>
Дата окончания интервала результатов выдачи (в формате 'DD-MM-YYYY HH:mm:ss')
</p>
</form>


## Get specified activity




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/activitylog/ut" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/activitylog/ut"
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
<div id="execution-results-GETapi-v1-activitylog--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-activitylog--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-activitylog--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-activitylog--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-activitylog--id-"></code></pre>
</div>
<form id="form-GETapi-v1-activitylog--id-" data-method="GET" data-path="api/v1/activitylog/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-activitylog--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-activitylog--id-" onclick="tryItOut('GETapi-v1-activitylog--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-activitylog--id-" onclick="cancelTryOut('GETapi-v1-activitylog--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-activitylog--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/activitylog/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-activitylog--id-" data-component="url" required  hidden>
<br>

</p>
</form>



