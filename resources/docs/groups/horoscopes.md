# horoscopes

API для работы с гороскопами.

## Get specified horoscope




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/app/horoscope" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/horoscope"
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
<div id="execution-results-GETapi-v1-app-horoscope" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-horoscope"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-horoscope"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-horoscope" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-horoscope"></code></pre>
</div>
<form id="form-GETapi-v1-app-horoscope" data-method="GET" data-path="api/v1/app/horoscope" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-horoscope', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-horoscope" onclick="tryItOut('GETapi-v1-app-horoscope');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-horoscope" onclick="cancelTryOut('GETapi-v1-app-horoscope');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-horoscope" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/horoscope</code></b>
</p>
</form>



