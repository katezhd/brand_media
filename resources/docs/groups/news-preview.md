# News Preview

API для работы с предпросмотром новости.

## Get specified News




> Example request:

```bash
curl -X GET \
    -G "http://brand.media.test/api/v1/app/preview/facilis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand.media.test/api/v1/app/preview/facilis"
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
<div id="execution-results-GETapi-v1-app-preview--id-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-preview--id-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-preview--id-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-preview--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-preview--id-"></code></pre>
</div>
<form id="form-GETapi-v1-app-preview--id-" data-method="GET" data-path="api/v1/app/preview/{id}" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-preview--id-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-preview--id-" onclick="tryItOut('GETapi-v1-app-preview--id-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-preview--id-" onclick="cancelTryOut('GETapi-v1-app-preview--id-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-preview--id-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/preview/{id}</code></b>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id" data-endpoint="GETapi-v1-app-preview--id-" data-component="url" required  hidden>
<br>

</p>
</form>



