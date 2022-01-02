# currency

API для работы с курсом валют.

## List of currency




> Example request:

```bash
curl -X GET \
    -G "http://brand_media.test/api/v1/app/currency" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://brand_media.test/api/v1/app/currency"
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


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "USD",
        "sale": "26.40000",
        "purchase": "26.00000",
        "created_at": "2021-11-09 09:14:24"
    },
    {
        "id": 2,
        "name": "EUR",
        "sale": "30.50000",
        "purchase": "29.90000",
        "created_at": "2021-11-09 09:14:24"
    },
    {
        "id": 3,
        "name": "RUR",
        "sale": "0.38000",
        "purchase": "0.35000",
        "created_at": "2021-11-09 09:14:24"
    },
    {
        "id": 4,
        "name": "BTC",
        "sale": "71408.3203",
        "purchase": "64607.5279",
        "created_at": "2021-11-09 09:14:24"
    }
]
```
<div id="execution-results-GETapi-v1-app-currency" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-app-currency"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-app-currency"></code></pre>
</div>
<div id="execution-error-GETapi-v1-app-currency" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-app-currency"></code></pre>
</div>
<form id="form-GETapi-v1-app-currency" data-method="GET" data-path="api/v1/app/currency" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-app-currency', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-app-currency" onclick="tryItOut('GETapi-v1-app-currency');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-app-currency" onclick="cancelTryOut('GETapi-v1-app-currency');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-app-currency" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/app/currency</code></b>
</p>
</form>



