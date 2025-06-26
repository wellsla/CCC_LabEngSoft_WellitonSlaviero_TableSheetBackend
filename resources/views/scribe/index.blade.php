<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>TableSheet API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://host.docker.internal";
        var useCsrf = Boolean();
        var csrfUrl = "";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.1.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.1.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Register a new user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-login">
                                <a href="#authentication-POSTapi-login">Login user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-forgot-password">
                                <a href="#authentication-POSTapi-forgot-password">Send password reset link</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-reset-password">
                                <a href="#authentication-POSTapi-reset-password">Reset password</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                                <a href="#authentication-POSTapi-logout">Logout user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-user">
                                <a href="#authentication-GETapi-user">Get authenticated user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-email-resend">
                                <a href="#authentication-POSTapi-email-resend">Resend email verification</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-email-verify--id---hash-">
                                <a href="#authentication-GETapi-email-verify--id---hash-">Verify email address</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-books" class="tocify-header">
                <li class="tocify-item level-1" data-unique="books">
                    <a href="#books">Books</a>
                </li>
                                    <ul id="tocify-subheader-books" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="books-GETapi-books">
                                <a href="#books-GETapi-books">GET api/books</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="books-GETapi-books--book-">
                                <a href="#books-GETapi-books--book-">GET api/books/{book}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="books-POSTapi-books">
                                <a href="#books-POSTapi-books">POST api/books</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="books-PUTapi-books--book-">
                                <a href="#books-PUTapi-books--book-">PUT api/books/{book}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="books-DELETEapi-books--book-">
                                <a href="#books-DELETEapi-books--book-">DELETE api/books/{book}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-character-sheets" class="tocify-header">
                <li class="tocify-item level-1" data-unique="character-sheets">
                    <a href="#character-sheets">Character Sheets</a>
                </li>
                                    <ul id="tocify-subheader-character-sheets" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="character-sheets-GETapi-sheets">
                                <a href="#character-sheets-GETapi-sheets">List character sheets</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="character-sheets-POSTapi-sheets">
                                <a href="#character-sheets-POSTapi-sheets">Create character sheet</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="character-sheets-GETapi-sheets--sheet-">
                                <a href="#character-sheets-GETapi-sheets--sheet-">Get character sheet</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="character-sheets-PUTapi-sheets--sheet-">
                                <a href="#character-sheets-PUTapi-sheets--sheet-">Update character sheet</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="character-sheets-DELETEapi-sheets--sheet-">
                                <a href="#character-sheets-DELETEapi-sheets--sheet-">Delete character sheet</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-classes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="classes">
                    <a href="#classes">Classes</a>
                </li>
                                    <ul id="tocify-subheader-classes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="classes-GETapi-classes">
                                <a href="#classes-GETapi-classes">GET api/classes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="classes-GETapi-classes--class-">
                                <a href="#classes-GETapi-classes--class-">GET api/classes/{class}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="classes-POSTapi-classes">
                                <a href="#classes-POSTapi-classes">POST api/classes</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="classes-PUTapi-classes--class-">
                                <a href="#classes-PUTapi-classes--class-">PUT api/classes/{class}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="classes-DELETEapi-classes--class-">
                                <a href="#classes-DELETEapi-classes--class-">DELETE api/classes/{class}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-endpoints" class="tocify-header">
                <li class="tocify-item level-1" data-unique="endpoints">
                    <a href="#endpoints">Endpoints</a>
                </li>
                                    <ul id="tocify-subheader-endpoints" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="endpoints-POSTapi-upload-avatar">
                                <a href="#endpoints-POSTapi-upload-avatar">Upload avatar for authenticated user</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-upload-portrait">
                                <a href="#endpoints-POSTapi-upload-portrait">Upload portrait for character sheet (only sheet owner)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-upload-file">
                                <a href="#endpoints-DELETEapi-upload-file">DELETE api/upload/file</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-upload-cover-image">
                                <a href="#endpoints-POSTapi-upload-cover-image">Upload cover image for game (admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-upload-document">
                                <a href="#endpoints-POSTapi-upload-document">Upload document for book (admin only)</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-GETapi-users">
                                <a href="#endpoints-GETapi-users">GET api/users</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-PUTapi-users--user-">
                                <a href="#endpoints-PUTapi-users--user-">PUT api/users/{user}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-POSTapi-users--user--suspend">
                                <a href="#endpoints-POSTapi-users--user--suspend">POST api/users/{user}/suspend</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="endpoints-DELETEapi-users--user-">
                                <a href="#endpoints-DELETEapi-users--user-">DELETE api/users/{user}</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-games" class="tocify-header">
                <li class="tocify-item level-1" data-unique="games">
                    <a href="#games">Games</a>
                </li>
                                    <ul id="tocify-subheader-games" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="games-GETapi-games">
                                <a href="#games-GETapi-games">List games</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="games-GETapi-games--game-">
                                <a href="#games-GETapi-games--game-">Get game details</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="games-POSTapi-games">
                                <a href="#games-POSTapi-games">Create game</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="games-PUTapi-games--game-">
                                <a href="#games-PUTapi-games--game-">Update game</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="games-DELETEapi-games--game-">
                                <a href="#games-DELETEapi-games--game-">Delete game</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-health" class="tocify-header">
                <li class="tocify-item level-1" data-unique="health">
                    <a href="#health">Health</a>
                </li>
                                    <ul id="tocify-subheader-health" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="health-GETapi-health">
                                <a href="#health-GETapi-health">Health check</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-profile" class="tocify-header">
                <li class="tocify-item level-1" data-unique="profile">
                    <a href="#profile">Profile</a>
                </li>
                                    <ul id="tocify-subheader-profile" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="profile-GETapi-profile">
                                <a href="#profile-GETapi-profile">Get user profile</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="profile-PUTapi-profile">
                                <a href="#profile-PUTapi-profile">Update user profile</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-races" class="tocify-header">
                <li class="tocify-item level-1" data-unique="races">
                    <a href="#races">Races</a>
                </li>
                                    <ul id="tocify-subheader-races" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="races-GETapi-races">
                                <a href="#races-GETapi-races">GET api/races</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="races-GETapi-races--race-">
                                <a href="#races-GETapi-races--race-">GET api/races/{race}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="races-POSTapi-races">
                                <a href="#races-POSTapi-races">POST api/races</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="races-PUTapi-races--race-">
                                <a href="#races-PUTapi-races--race-">PUT api/races/{race}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="races-DELETEapi-races--race-">
                                <a href="#races-DELETEapi-races--race-">DELETE api/races/{race}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: {date}</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>API documentation for the TableSheet backend - a web system to manage tabletop RPG games and character sheets.</p>
<aside>
    <strong>Base URL</strong>: <code>http://host.docker.internal</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.
&lt;aside&gt;Base URL: &lt;code&gt;{base_url}&lt;/code&gt;&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {YOUR_AUTH_KEY}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>You can retrieve your token by making a POST request to <code>/login</code> endpoint.</p>

        <h1 id="authentication">Authentication</h1>

    <p>APIs for user authentication and account management</p>

                                <h2 id="authentication-POSTapi-register">Register a new user</h2>

<p>
</p>

<p>Create a new user account. Email verification is required before login.</p>

<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"john_doe\",
    \"name\": \"John Doe\",
    \"email\": \"john@example.com\",
    \"password\": \"password123\",
    \"birth_date\": \"1990-01-01\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "john_doe",
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123",
    "birth_date": "1990-01-01"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Registration successful. Please verify your email.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;username&quot;: &quot;john_doe&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;birth_date&quot;: &quot;1990-01-01&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-register"
               value="john_doe"
               data-component="body">
    <br>
<p>The unique username. Example: <code>john_doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-register"
               value="John Doe"
               data-component="body">
    <br>
<p>The user's full name. Example: <code>John Doe</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-register"
               value="password123"
               data-component="body">
    <br>
<p>The user's password (min 8 characters). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="POSTapi-register"
               value="1990-01-01"
               data-component="body">
    <br>
<p>The user's birth date (YYYY-MM-DD). Example: <code>1990-01-01</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-login">Login user</h2>

<p>
</p>

<p>Authenticate user and return access token. Email must be verified.</p>

<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"john@example.com\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "john@example.com",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Login successful&quot;,
    &quot;data&quot;: {
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;username&quot;: &quot;john_doe&quot;,
            &quot;name&quot;: &quot;John Doe&quot;,
            &quot;email&quot;: &quot;john@example.com&quot;
        },
        &quot;token&quot;: &quot;1|abc123def456...&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Please verify your email before logging in.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-login"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="password123"
               data-component="body">
    <br>
<p>The user's password. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-forgot-password">Send password reset link</h2>

<p>
</p>

<p>Send a password reset link to the user's email address.</p>

<span id="example-requests-POSTapi-forgot-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/forgot-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"john@example.com\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/forgot-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "john@example.com"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-forgot-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Password reset link sent&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unable to send reset link&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The selected email is invalid.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-forgot-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-forgot-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-forgot-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-forgot-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-forgot-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-forgot-password" data-method="POST"
      data-path="api/forgot-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-forgot-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-forgot-password"
                    onclick="tryItOut('POSTapi-forgot-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-forgot-password"
                    onclick="cancelTryOut('POSTapi-forgot-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-forgot-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/forgot-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-forgot-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-forgot-password"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john@example.com</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-reset-password">Reset password</h2>

<p>
</p>

<p>Reset the user's password using the reset token received via email.</p>

<span id="example-requests-POSTapi-reset-password">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/reset-password" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"token\": \"abc123def456\",
    \"email\": \"john@example.com\",
    \"password\": \"newpassword123\",
    \"password_confirmation\": \"newpassword123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/reset-password"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "abc123def456",
    "email": "john@example.com",
    "password": "newpassword123",
    "password_confirmation": "newpassword123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-reset-password">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Password reset successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unable to reset password&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;password&quot;: [
            &quot;The password confirmation does not match.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-reset-password" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-reset-password"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-reset-password"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-reset-password" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-reset-password">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-reset-password" data-method="POST"
      data-path="api/reset-password"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-reset-password', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-reset-password"
                    onclick="tryItOut('POSTapi-reset-password');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-reset-password"
                    onclick="cancelTryOut('POSTapi-reset-password');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-reset-password"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/reset-password</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-reset-password"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-reset-password"
               value="abc123def456"
               data-component="body">
    <br>
<p>The password reset token. Example: <code>abc123def456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-reset-password"
               value="john@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-reset-password"
               value="newpassword123"
               data-component="body">
    <br>
<p>The new password (min 8 characters). Example: <code>newpassword123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-reset-password"
               value="newpassword123"
               data-component="body">
    <br>
<p>Password confirmation. Example: <code>newpassword123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-logout">Logout user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Revoke the current access token and logout the user.</p>

<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/logout" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/logout"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Logout successful&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-logout"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-GETapi-user">Get authenticated user</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve the currently authenticated user's information.</p>

<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/user" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/user"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;username&quot;: &quot;john_doe&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;birth_date&quot;: &quot;1990-01-01&quot;,
        &quot;avatar_url&quot;: null,
        &quot;is_admin&quot;: false,
        &quot;is_suspended&quot;: false,
        &quot;email_verified_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-user"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-email-resend">Resend email verification</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Resend the email verification notification to the authenticated user.</p>

<span id="example-requests-POSTapi-email-resend">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/email/resend" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/email/resend"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-email-resend">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Verification email sent&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Email already verified&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-email-resend" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-email-resend"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-email-resend"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-email-resend" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-email-resend">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-email-resend" data-method="POST"
      data-path="api/email/resend"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-email-resend', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-email-resend"
                    onclick="tryItOut('POSTapi-email-resend');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-email-resend"
                    onclick="cancelTryOut('POSTapi-email-resend');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-email-resend"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/email/resend</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-email-resend"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-email-resend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-email-resend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-GETapi-email-verify--id---hash-">Verify email address</h2>

<p>
</p>

<p>Verify a user's email address using the verification link sent via email.</p>

<span id="example-requests-GETapi-email-verify--id---hash-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/email/verify/1/abc123def456" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/email/verify/1/abc123def456"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-email-verify--id---hash-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Email verified successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (400):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invalid verification link&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;User not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-email-verify--id---hash-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-email-verify--id---hash-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-email-verify--id---hash-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-email-verify--id---hash-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-email-verify--id---hash-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-email-verify--id---hash-" data-method="GET"
      data-path="api/email/verify/{id}/{hash}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-email-verify--id---hash-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-email-verify--id---hash-"
                    onclick="tryItOut('GETapi-email-verify--id---hash-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-email-verify--id---hash-"
                    onclick="cancelTryOut('GETapi-email-verify--id---hash-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-email-verify--id---hash-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/email/verify/{id}/{hash}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-email-verify--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-email-verify--id---hash-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-email-verify--id---hash-"
               value="1"
               data-component="url">
    <br>
<p>The user ID. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>hash</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="hash"                data-endpoint="GETapi-email-verify--id---hash-"
               value="abc123def456"
               data-component="url">
    <br>
<p>The verification hash. Example: <code>abc123def456</code></p>
            </div>
                    </form>

                <h1 id="books">Books</h1>

    <p>APIs for managing tabletop RPG books/documents</p>

                                <h2 id="books-GETapi-books">GET api/books</h2>

<p>
</p>



<span id="example-requests-GETapi-books">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/books" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/books"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-books">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://host.docker.internal:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;N&atilde;o autenticado.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-books" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-books"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-books"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-books" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-books">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-books" data-method="GET"
      data-path="api/books"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-books', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-books"
                    onclick="tryItOut('GETapi-books');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-books"
                    onclick="cancelTryOut('GETapi-books');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-books"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/books</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-books"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-books"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="books-GETapi-books--book-">GET api/books/{book}</h2>

<p>
</p>



<span id="example-requests-GETapi-books--book-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/books/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/books/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-books--book-">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://host.docker.internal:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;N&atilde;o autenticado.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-books--book-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-books--book-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-books--book-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-books--book-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-books--book-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-books--book-" data-method="GET"
      data-path="api/books/{book}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-books--book-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-books--book-"
                    onclick="tryItOut('GETapi-books--book-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-books--book-"
                    onclick="cancelTryOut('GETapi-books--book-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-books--book-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/books/{book}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-books--book-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-books--book-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>book</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="book"                data-endpoint="GETapi-books--book-"
               value="architecto"
               data-component="url">
    <br>
<p>The book. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="books-POSTapi-books">POST api/books</h2>

<p>
</p>



<span id="example-requests-POSTapi-books">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/books" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"game_id\": \"architecto\",
    \"name\": \"n\",
    \"description\": \"Eius et animi quos velit et.\",
    \"document_url\": \"http:\\/\\/www.ernser.org\\/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/books"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "game_id": "architecto",
    "name": "n",
    "description": "Eius et animi quos velit et.",
    "document_url": "http:\/\/www.ernser.org\/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-books">
</span>
<span id="execution-results-POSTapi-books" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-books"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-books"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-books" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-books">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-books" data-method="POST"
      data-path="api/books"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-books', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-books"
                    onclick="tryItOut('POSTapi-books');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-books"
                    onclick="cancelTryOut('POSTapi-books');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-books"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/books</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-books"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-books"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="POSTapi-books"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-books"
               value="n"
               data-component="body">
    <br>
<p>O campo value não pode ser maior que 255 caracteres. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-books"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="document_url"                data-endpoint="POSTapi-books"
               value="http://www.ernser.org/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html"
               data-component="body">
    <br>
<p>Must be a valid URL. Example: <code>http://www.ernser.org/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html</code></p>
        </div>
        </form>

                    <h2 id="books-PUTapi-books--book-">PUT api/books/{book}</h2>

<p>
</p>



<span id="example-requests-PUTapi-books--book-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/books/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"description\": \"Eius et animi quos velit et.\",
    \"document_url\": \"http:\\/\\/www.ernser.org\\/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/books/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "description": "Eius et animi quos velit et.",
    "document_url": "http:\/\/www.ernser.org\/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-books--book-">
</span>
<span id="execution-results-PUTapi-books--book-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-books--book-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-books--book-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-books--book-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-books--book-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-books--book-" data-method="PUT"
      data-path="api/books/{book}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-books--book-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-books--book-"
                    onclick="tryItOut('PUTapi-books--book-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-books--book-"
                    onclick="cancelTryOut('PUTapi-books--book-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-books--book-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/books/{book}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-books--book-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-books--book-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>book</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="book"                data-endpoint="PUTapi-books--book-"
               value="architecto"
               data-component="url">
    <br>
<p>The book. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="PUTapi-books--book-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-books--book-"
               value="b"
               data-component="body">
    <br>
<p>O campo value não pode ser maior que 255 caracteres. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-books--book-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>document_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="document_url"                data-endpoint="PUTapi-books--book-"
               value="http://www.ernser.org/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html"
               data-component="body">
    <br>
<p>Must be a valid URL. Example: <code>http://www.ernser.org/harum-mollitia-modi-deserunt-aut-ab-provident-perspiciatis-quo.html</code></p>
        </div>
        </form>

                    <h2 id="books-DELETEapi-books--book-">DELETE api/books/{book}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-books--book-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/books/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/books/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-books--book-">
</span>
<span id="execution-results-DELETEapi-books--book-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-books--book-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-books--book-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-books--book-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-books--book-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-books--book-" data-method="DELETE"
      data-path="api/books/{book}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-books--book-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-books--book-"
                    onclick="tryItOut('DELETEapi-books--book-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-books--book-"
                    onclick="cancelTryOut('DELETEapi-books--book-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-books--book-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/books/{book}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-books--book-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-books--book-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>book</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="book"                data-endpoint="DELETEapi-books--book-"
               value="architecto"
               data-component="url">
    <br>
<p>The book. Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="character-sheets">Character Sheets</h1>

    <p>APIs for managing character sheets for tabletop RPG games</p>

                                <h2 id="character-sheets-GETapi-sheets">List character sheets</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a paginated list of character sheets. Regular users see only their own sheets, while admins see all sheets.</p>

<span id="example-requests-GETapi-sheets">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/sheets?per_page=10&amp;name=Aragorn&amp;status=active&amp;game_id=1&amp;sort=name&amp;direction=asc" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/sheets"
);

const params = {
    "per_page": "10",
    "name": "Aragorn",
    "status": "active",
    "game_id": "1",
    "sort": "name",
    "direction": "asc",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-sheets">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Aragorn&quot;,
            &quot;level&quot;: 5,
            &quot;strength&quot;: 16,
            &quot;dexterity&quot;: 14,
            &quot;constitution&quot;: 15,
            &quot;intelligence&quot;: 12,
            &quot;wisdom&quot;: 13,
            &quot;charisma&quot;: 14,
            &quot;current_hit_points&quot;: 45,
            &quot;max_hit_points&quot;: 50,
            &quot;armor_class&quot;: 18,
            &quot;initiative&quot;: 2,
            &quot;speed&quot;: 30,
            &quot;description&quot;: &quot;A ranger from the North&quot;,
            &quot;notes&quot;: &quot;Has a magical sword&quot;,
            &quot;portrait_url&quot;: &quot;https://example.com/portrait.jpg&quot;,
            &quot;is_active&quot;: true,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5e&quot;
            },
            &quot;race&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Human&quot;
            },
            &quot;class&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Ranger&quot;
            }
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    },
    &quot;message&quot;: &quot;Character sheets retrieved successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-sheets" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-sheets"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-sheets"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-sheets" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-sheets">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-sheets" data-method="GET"
      data-path="api/sheets"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-sheets', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-sheets"
                    onclick="tryItOut('GETapi-sheets');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-sheets"
                    onclick="cancelTryOut('GETapi-sheets');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-sheets"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/sheets</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-sheets"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-sheets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-sheets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-sheets"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page (default: 15). Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-sheets"
               value="Aragorn"
               data-component="query">
    <br>
<p>Filter by character name. Example: <code>Aragorn</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-sheets"
               value="active"
               data-component="query">
    <br>
<p>Filter by status (active/inactive). Example: <code>active</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="game_id"                data-endpoint="GETapi-sheets"
               value="1"
               data-component="query">
    <br>
<p>Filter by game ID. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-sheets"
               value="name"
               data-component="query">
    <br>
<p>Sort field (name, level, created_at, updated_at). Example: <code>name</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="direction"                data-endpoint="GETapi-sheets"
               value="asc"
               data-component="query">
    <br>
<p>Sort direction (asc/desc). Example: <code>asc</code></p>
            </div>
                </form>

                    <h2 id="character-sheets-POSTapi-sheets">Create character sheet</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new character sheet for the authenticated user.</p>

<span id="example-requests-POSTapi-sheets">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/sheets" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"game_id\": 1,
    \"race_id\": 1,
    \"class_id\": 1,
    \"name\": \"Aragorn\",
    \"level\": 5,
    \"strength\": 16,
    \"dexterity\": 14,
    \"constitution\": 15,
    \"intelligence\": 12,
    \"wisdom\": 13,
    \"charisma\": 14,
    \"current_hit_points\": 45,
    \"max_hit_points\": 50,
    \"armor_class\": 18,
    \"initiative\": 2,
    \"speed\": 30,
    \"description\": \"A ranger from the North\",
    \"notes\": \"Has a magical sword\",
    \"portrait_url\": \"https:\\/\\/example.com\\/portrait.jpg\",
    \"is_active\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/sheets"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "game_id": 1,
    "race_id": 1,
    "class_id": 1,
    "name": "Aragorn",
    "level": 5,
    "strength": 16,
    "dexterity": 14,
    "constitution": 15,
    "intelligence": 12,
    "wisdom": 13,
    "charisma": 14,
    "current_hit_points": 45,
    "max_hit_points": 50,
    "armor_class": 18,
    "initiative": 2,
    "speed": 30,
    "description": "A ranger from the North",
    "notes": "Has a magical sword",
    "portrait_url": "https:\/\/example.com\/portrait.jpg",
    "is_active": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-sheets">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Aragorn&quot;,
        &quot;level&quot;: 5,
        &quot;strength&quot;: 16,
        &quot;dexterity&quot;: 14,
        &quot;constitution&quot;: 15,
        &quot;intelligence&quot;: 12,
        &quot;wisdom&quot;: 13,
        &quot;charisma&quot;: 14,
        &quot;current_hit_points&quot;: 45,
        &quot;max_hit_points&quot;: 50,
        &quot;armor_class&quot;: 18,
        &quot;initiative&quot;: 2,
        &quot;speed&quot;: 30,
        &quot;description&quot;: &quot;A ranger from the North&quot;,
        &quot;notes&quot;: &quot;Has a magical sword&quot;,
        &quot;portrait_url&quot;: &quot;https://example.com/portrait.jpg&quot;,
        &quot;is_active&quot;: true,
        &quot;game&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dungeons &amp; Dragons 5e&quot;
        },
        &quot;race&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Human&quot;
        },
        &quot;class&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Ranger&quot;
        }
    },
    &quot;message&quot;: &quot;Character sheet created successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-sheets" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-sheets"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-sheets"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-sheets" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-sheets">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-sheets" data-method="POST"
      data-path="api/sheets"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-sheets', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-sheets"
                    onclick="tryItOut('POSTapi-sheets');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-sheets"
                    onclick="cancelTryOut('POSTapi-sheets');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-sheets"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/sheets</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-sheets"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-sheets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-sheets"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="game_id"                data-endpoint="POSTapi-sheets"
               value="1"
               data-component="body">
    <br>
<p>The game ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>race_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="race_id"                data-endpoint="POSTapi-sheets"
               value="1"
               data-component="body">
    <br>
<p>The race ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>class_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="class_id"                data-endpoint="POSTapi-sheets"
               value="1"
               data-component="body">
    <br>
<p>The class ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-sheets"
               value="Aragorn"
               data-component="body">
    <br>
<p>The character name. Example: <code>Aragorn</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>level</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="level"                data-endpoint="POSTapi-sheets"
               value="5"
               data-component="body">
    <br>
<p>The character level (default: 1). Example: <code>5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>strength</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="strength"                data-endpoint="POSTapi-sheets"
               value="16"
               data-component="body">
    <br>
<p>Strength attribute. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dexterity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="dexterity"                data-endpoint="POSTapi-sheets"
               value="14"
               data-component="body">
    <br>
<p>Dexterity attribute. Example: <code>14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>constitution</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="constitution"                data-endpoint="POSTapi-sheets"
               value="15"
               data-component="body">
    <br>
<p>Constitution attribute. Example: <code>15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>intelligence</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="intelligence"                data-endpoint="POSTapi-sheets"
               value="12"
               data-component="body">
    <br>
<p>Intelligence attribute. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>wisdom</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="wisdom"                data-endpoint="POSTapi-sheets"
               value="13"
               data-component="body">
    <br>
<p>Wisdom attribute. Example: <code>13</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>charisma</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="charisma"                data-endpoint="POSTapi-sheets"
               value="14"
               data-component="body">
    <br>
<p>Charisma attribute. Example: <code>14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_hit_points</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="current_hit_points"                data-endpoint="POSTapi-sheets"
               value="45"
               data-component="body">
    <br>
<p>Current hit points. Example: <code>45</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>max_hit_points</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="max_hit_points"                data-endpoint="POSTapi-sheets"
               value="50"
               data-component="body">
    <br>
<p>Maximum hit points. Example: <code>50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>armor_class</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="armor_class"                data-endpoint="POSTapi-sheets"
               value="18"
               data-component="body">
    <br>
<p>Armor class. Example: <code>18</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>initiative</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="initiative"                data-endpoint="POSTapi-sheets"
               value="2"
               data-component="body">
    <br>
<p>Initiative modifier. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>speed</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="speed"                data-endpoint="POSTapi-sheets"
               value="30"
               data-component="body">
    <br>
<p>Movement speed. Example: <code>30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-sheets"
               value="A ranger from the North"
               data-component="body">
    <br>
<p>Character description. Example: <code>A ranger from the North</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="POSTapi-sheets"
               value="Has a magical sword"
               data-component="body">
    <br>
<p>Character notes. Example: <code>Has a magical sword</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>portrait_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="portrait_url"                data-endpoint="POSTapi-sheets"
               value="https://example.com/portrait.jpg"
               data-component="body">
    <br>
<p>Character portrait URL. Example: <code>https://example.com/portrait.jpg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTapi-sheets" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="POSTapi-sheets"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-sheets" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="POSTapi-sheets"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Se o personagem está ativo. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="character-sheets-GETapi-sheets--sheet-">Get character sheet</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve a specific character sheet by ID. Users can only view their own sheets unless they are admin.</p>

<span id="example-requests-GETapi-sheets--sheet-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/sheets/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/sheets/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-sheets--sheet-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Aragorn&quot;,
        &quot;level&quot;: 5,
        &quot;strength&quot;: 16,
        &quot;dexterity&quot;: 14,
        &quot;constitution&quot;: 15,
        &quot;intelligence&quot;: 12,
        &quot;wisdom&quot;: 13,
        &quot;charisma&quot;: 14,
        &quot;current_hit_points&quot;: 45,
        &quot;max_hit_points&quot;: 50,
        &quot;armor_class&quot;: 18,
        &quot;initiative&quot;: 2,
        &quot;speed&quot;: 30,
        &quot;description&quot;: &quot;A ranger from the North&quot;,
        &quot;notes&quot;: &quot;Has a magical sword&quot;,
        &quot;portrait_url&quot;: &quot;https://example.com/portrait.jpg&quot;,
        &quot;is_active&quot;: true,
        &quot;user&quot;: {
            &quot;id&quot;: 1,
            &quot;username&quot;: &quot;john_doe&quot;,
            &quot;name&quot;: &quot;John Doe&quot;
        },
        &quot;game&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dungeons &amp; Dragons 5e&quot;
        },
        &quot;race&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Human&quot;
        },
        &quot;class&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Ranger&quot;
        }
    },
    &quot;message&quot;: &quot;Character sheet retrieved successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Character sheet not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-sheets--sheet-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-sheets--sheet-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-sheets--sheet-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-sheets--sheet-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-sheets--sheet-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-sheets--sheet-" data-method="GET"
      data-path="api/sheets/{sheet}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-sheets--sheet-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-sheets--sheet-"
                    onclick="tryItOut('GETapi-sheets--sheet-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-sheets--sheet-"
                    onclick="cancelTryOut('GETapi-sheets--sheet-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-sheets--sheet-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/sheets/{sheet}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-sheets--sheet-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-sheets--sheet-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-sheets--sheet-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sheet</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sheet"                data-endpoint="GETapi-sheets--sheet-"
               value="1"
               data-component="url">
    <br>
<p>The character sheet ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="character-sheets-PUTapi-sheets--sheet-">Update character sheet</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing character sheet. Users can only update their own sheets unless they are admin.</p>

<span id="example-requests-PUTapi-sheets--sheet-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/sheets/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"game_id\": 1,
    \"race_id\": 1,
    \"class_id\": 1,
    \"name\": \"Aragorn\",
    \"level\": 6,
    \"strength\": 17,
    \"dexterity\": 14,
    \"constitution\": 15,
    \"intelligence\": 12,
    \"wisdom\": 13,
    \"charisma\": 14,
    \"current_hit_points\": 50,
    \"max_hit_points\": 55,
    \"armor_class\": 19,
    \"initiative\": 2,
    \"speed\": 30,
    \"description\": \"A ranger from the North\",
    \"notes\": \"Has a magical sword\",
    \"portrait_url\": \"https:\\/\\/example.com\\/portrait.jpg\",
    \"is_active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/sheets/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "game_id": 1,
    "race_id": 1,
    "class_id": 1,
    "name": "Aragorn",
    "level": 6,
    "strength": 17,
    "dexterity": 14,
    "constitution": 15,
    "intelligence": 12,
    "wisdom": 13,
    "charisma": 14,
    "current_hit_points": 50,
    "max_hit_points": 55,
    "armor_class": 19,
    "initiative": 2,
    "speed": 30,
    "description": "A ranger from the North",
    "notes": "Has a magical sword",
    "portrait_url": "https:\/\/example.com\/portrait.jpg",
    "is_active": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-sheets--sheet-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Aragorn&quot;,
        &quot;level&quot;: 6,
        &quot;strength&quot;: 17,
        &quot;current_hit_points&quot;: 50,
        &quot;max_hit_points&quot;: 55,
        &quot;armor_class&quot;: 19,
        &quot;game&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dungeons &amp; Dragons 5e&quot;
        },
        &quot;race&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Human&quot;
        },
        &quot;class&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Ranger&quot;
        }
    },
    &quot;message&quot;: &quot;Character sheet updated successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-sheets--sheet-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-sheets--sheet-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-sheets--sheet-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-sheets--sheet-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-sheets--sheet-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-sheets--sheet-" data-method="PUT"
      data-path="api/sheets/{sheet}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-sheets--sheet-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-sheets--sheet-"
                    onclick="tryItOut('PUTapi-sheets--sheet-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-sheets--sheet-"
                    onclick="cancelTryOut('PUTapi-sheets--sheet-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-sheets--sheet-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/sheets/{sheet}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-sheets--sheet-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-sheets--sheet-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-sheets--sheet-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sheet</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sheet"                data-endpoint="PUTapi-sheets--sheet-"
               value="1"
               data-component="url">
    <br>
<p>The character sheet ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="game_id"                data-endpoint="PUTapi-sheets--sheet-"
               value="1"
               data-component="body">
    <br>
<p>The game ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>race_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="race_id"                data-endpoint="PUTapi-sheets--sheet-"
               value="1"
               data-component="body">
    <br>
<p>The race ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>class_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="class_id"                data-endpoint="PUTapi-sheets--sheet-"
               value="1"
               data-component="body">
    <br>
<p>The class ID. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-sheets--sheet-"
               value="Aragorn"
               data-component="body">
    <br>
<p>The character name. Example: <code>Aragorn</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>level</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="level"                data-endpoint="PUTapi-sheets--sheet-"
               value="6"
               data-component="body">
    <br>
<p>The character level. Example: <code>6</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>strength</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="strength"                data-endpoint="PUTapi-sheets--sheet-"
               value="17"
               data-component="body">
    <br>
<p>Strength attribute. Example: <code>17</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>dexterity</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="dexterity"                data-endpoint="PUTapi-sheets--sheet-"
               value="14"
               data-component="body">
    <br>
<p>Dexterity attribute. Example: <code>14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>constitution</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="constitution"                data-endpoint="PUTapi-sheets--sheet-"
               value="15"
               data-component="body">
    <br>
<p>Constitution attribute. Example: <code>15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>intelligence</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="intelligence"                data-endpoint="PUTapi-sheets--sheet-"
               value="12"
               data-component="body">
    <br>
<p>Intelligence attribute. Example: <code>12</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>wisdom</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="wisdom"                data-endpoint="PUTapi-sheets--sheet-"
               value="13"
               data-component="body">
    <br>
<p>Wisdom attribute. Example: <code>13</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>charisma</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="charisma"                data-endpoint="PUTapi-sheets--sheet-"
               value="14"
               data-component="body">
    <br>
<p>Charisma attribute. Example: <code>14</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>current_hit_points</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="current_hit_points"                data-endpoint="PUTapi-sheets--sheet-"
               value="50"
               data-component="body">
    <br>
<p>Current hit points. Example: <code>50</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>max_hit_points</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="max_hit_points"                data-endpoint="PUTapi-sheets--sheet-"
               value="55"
               data-component="body">
    <br>
<p>Maximum hit points. Example: <code>55</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>armor_class</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="armor_class"                data-endpoint="PUTapi-sheets--sheet-"
               value="19"
               data-component="body">
    <br>
<p>Armor class. Example: <code>19</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>initiative</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="initiative"                data-endpoint="PUTapi-sheets--sheet-"
               value="2"
               data-component="body">
    <br>
<p>Initiative modifier. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>speed</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="speed"                data-endpoint="PUTapi-sheets--sheet-"
               value="30"
               data-component="body">
    <br>
<p>Movement speed. Example: <code>30</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-sheets--sheet-"
               value="A ranger from the North"
               data-component="body">
    <br>
<p>Character description. Example: <code>A ranger from the North</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>notes</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="notes"                data-endpoint="PUTapi-sheets--sheet-"
               value="Has a magical sword"
               data-component="body">
    <br>
<p>Character notes. Example: <code>Has a magical sword</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>portrait_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="portrait_url"                data-endpoint="PUTapi-sheets--sheet-"
               value="https://example.com/portrait.jpg"
               data-component="body">
    <br>
<p>Character portrait URL. Example: <code>https://example.com/portrait.jpg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-sheets--sheet-" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="PUTapi-sheets--sheet-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-sheets--sheet-" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="PUTapi-sheets--sheet-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Character active status. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="character-sheets-DELETEapi-sheets--sheet-">Delete character sheet</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a character sheet. Users can only delete their own sheets unless they are admin.</p>

<span id="example-requests-DELETEapi-sheets--sheet-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/sheets/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/sheets/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-sheets--sheet-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Character sheet deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Character sheet not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-sheets--sheet-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-sheets--sheet-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-sheets--sheet-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-sheets--sheet-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-sheets--sheet-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-sheets--sheet-" data-method="DELETE"
      data-path="api/sheets/{sheet}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-sheets--sheet-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-sheets--sheet-"
                    onclick="tryItOut('DELETEapi-sheets--sheet-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-sheets--sheet-"
                    onclick="cancelTryOut('DELETEapi-sheets--sheet-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-sheets--sheet-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/sheets/{sheet}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-sheets--sheet-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-sheets--sheet-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-sheets--sheet-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sheet</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="sheet"                data-endpoint="DELETEapi-sheets--sheet-"
               value="1"
               data-component="url">
    <br>
<p>The character sheet ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="classes">Classes</h1>

    <p>APIs for managing tabletop RPG classes</p>

                                <h2 id="classes-GETapi-classes">GET api/classes</h2>

<p>
</p>



<span id="example-requests-GETapi-classes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/classes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/classes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-classes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://host.docker.internal:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Fighter&quot;,
            &quot;description&quot;: &quot;A master of martial combat, skilled with a variety of weapons and armor.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Wizard&quot;,
            &quot;description&quot;: &quot;A scholarly magic-user capable of manipulating the structures of reality.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Rogue&quot;,
            &quot;description&quot;: &quot;A scoundrel who uses stealth and trickery to achieve their goals.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Cleric&quot;,
            &quot;description&quot;: &quot;A priestly champion who wields divine magic in service of a higher power.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;game_id&quot;: 2,
            &quot;name&quot;: &quot;Fighter&quot;,
            &quot;description&quot;: &quot;Fighting for honor, greed, loyalty, or simply the thrill of battle, you are an undisputed master of weaponry and combat techniques.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Pathfinder 2nd Edition&quot;,
                &quot;description&quot;: &quot;A fantasy tabletop roleplaying game where players take on the role of brave adventurers fighting to survive in a world beset by magic and evil.&quot;,
                &quot;version&quot;: &quot;2.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;game_id&quot;: 2,
            &quot;name&quot;: &quot;Wizard&quot;,
            &quot;description&quot;: &quot;You seek to uncover the secrets of magic through careful study and rigorous academic pursuit.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Pathfinder 2nd Edition&quot;,
                &quot;description&quot;: &quot;A fantasy tabletop roleplaying game where players take on the role of brave adventurers fighting to survive in a world beset by magic and evil.&quot;,
                &quot;version&quot;: &quot;2.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    ],
    &quot;message&quot;: &quot;Classes retrieved successfully&quot;,
    &quot;meta&quot;: {
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;last_page&quot;: 1,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 6,
            &quot;from&quot;: 1,
            &quot;to&quot;: 6,
            &quot;has_more_pages&quot;: false,
            &quot;links&quot;: {
                &quot;first&quot;: &quot;http://host.docker.internal/api/classes?page=1&quot;,
                &quot;last&quot;: &quot;http://host.docker.internal/api/classes?page=1&quot;,
                &quot;prev&quot;: null,
                &quot;next&quot;: null
            }
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-classes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-classes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-classes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-classes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-classes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-classes" data-method="GET"
      data-path="api/classes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-classes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-classes"
                    onclick="tryItOut('GETapi-classes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-classes"
                    onclick="cancelTryOut('GETapi-classes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-classes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/classes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-classes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-classes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="classes-GETapi-classes--class-">GET api/classes/{class}</h2>

<p>
</p>



<span id="example-requests-GETapi-classes--class-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/classes/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/classes/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-classes--class-">
            <blockquote>
            <p>Example response (500):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://host.docker.internal:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Server Error&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-classes--class-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-classes--class-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-classes--class-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-classes--class-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-classes--class-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-classes--class-" data-method="GET"
      data-path="api/classes/{class}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-classes--class-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-classes--class-"
                    onclick="tryItOut('GETapi-classes--class-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-classes--class-"
                    onclick="cancelTryOut('GETapi-classes--class-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-classes--class-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/classes/{class}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-classes--class-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-classes--class-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>class</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="class"                data-endpoint="GETapi-classes--class-"
               value="architecto"
               data-component="url">
    <br>
<p>The class. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="classes-POSTapi-classes">POST api/classes</h2>

<p>
</p>



<span id="example-requests-POSTapi-classes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/classes" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"game_id\": \"architecto\",
    \"name\": \"n\",
    \"description\": \"Eius et animi quos velit et.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/classes"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "game_id": "architecto",
    "name": "n",
    "description": "Eius et animi quos velit et."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-classes">
</span>
<span id="execution-results-POSTapi-classes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-classes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-classes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-classes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-classes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-classes" data-method="POST"
      data-path="api/classes"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-classes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-classes"
                    onclick="tryItOut('POSTapi-classes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-classes"
                    onclick="cancelTryOut('POSTapi-classes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-classes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/classes</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-classes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-classes"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="POSTapi-classes"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-classes"
               value="n"
               data-component="body">
    <br>
<p>O campo value não pode ser maior que 255 caracteres. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-classes"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
        </form>

                    <h2 id="classes-PUTapi-classes--class-">PUT api/classes/{class}</h2>

<p>
</p>



<span id="example-requests-PUTapi-classes--class-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/classes/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"description\": \"Eius et animi quos velit et.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/classes/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "description": "Eius et animi quos velit et."
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-classes--class-">
</span>
<span id="execution-results-PUTapi-classes--class-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-classes--class-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-classes--class-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-classes--class-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-classes--class-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-classes--class-" data-method="PUT"
      data-path="api/classes/{class}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-classes--class-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-classes--class-"
                    onclick="tryItOut('PUTapi-classes--class-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-classes--class-"
                    onclick="cancelTryOut('PUTapi-classes--class-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-classes--class-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/classes/{class}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-classes--class-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-classes--class-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>class</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="class"                data-endpoint="PUTapi-classes--class-"
               value="architecto"
               data-component="url">
    <br>
<p>The class. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="PUTapi-classes--class-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-classes--class-"
               value="b"
               data-component="body">
    <br>
<p>O campo value não pode ser maior que 255 caracteres. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-classes--class-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
        </form>

                    <h2 id="classes-DELETEapi-classes--class-">DELETE api/classes/{class}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-classes--class-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/classes/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/classes/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-classes--class-">
</span>
<span id="execution-results-DELETEapi-classes--class-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-classes--class-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-classes--class-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-classes--class-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-classes--class-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-classes--class-" data-method="DELETE"
      data-path="api/classes/{class}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-classes--class-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-classes--class-"
                    onclick="tryItOut('DELETEapi-classes--class-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-classes--class-"
                    onclick="cancelTryOut('DELETEapi-classes--class-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-classes--class-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/classes/{class}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-classes--class-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-classes--class-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>class</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="class"                data-endpoint="DELETEapi-classes--class-"
               value="architecto"
               data-component="url">
    <br>
<p>The class. Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="endpoints">Endpoints</h1>

    

                                <h2 id="endpoints-POSTapi-upload-avatar">Upload avatar for authenticated user</h2>

<p>
</p>



<span id="example-requests-POSTapi-upload-avatar">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/upload/avatar" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/upload/avatar"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-upload-avatar">
</span>
<span id="execution-results-POSTapi-upload-avatar" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-upload-avatar"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-upload-avatar"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-upload-avatar" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-upload-avatar">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-upload-avatar" data-method="POST"
      data-path="api/upload/avatar"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-upload-avatar', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-upload-avatar"
                    onclick="tryItOut('POSTapi-upload-avatar');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-upload-avatar"
                    onclick="cancelTryOut('POSTapi-upload-avatar');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-upload-avatar"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/upload/avatar</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-upload-avatar"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-upload-avatar"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="avatar"                data-endpoint="POSTapi-upload-avatar"
               value=""
               data-component="body">
    <br>

        </div>
        </form>

                    <h2 id="endpoints-POSTapi-upload-portrait">Upload portrait for character sheet (only sheet owner)</h2>

<p>
</p>



<span id="example-requests-POSTapi-upload-portrait">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/upload/portrait" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"character_sheet_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/upload/portrait"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "character_sheet_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-upload-portrait">
</span>
<span id="execution-results-POSTapi-upload-portrait" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-upload-portrait"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-upload-portrait"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-upload-portrait" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-upload-portrait">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-upload-portrait" data-method="POST"
      data-path="api/upload/portrait"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-upload-portrait', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-upload-portrait"
                    onclick="tryItOut('POSTapi-upload-portrait');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-upload-portrait"
                    onclick="cancelTryOut('POSTapi-upload-portrait');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-upload-portrait"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/upload/portrait</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-upload-portrait"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-upload-portrait"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>character_sheet_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="character_sheet_id"                data-endpoint="POSTapi-upload-portrait"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the character_sheets table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-DELETEapi-upload-file">DELETE api/upload/file</h2>

<p>
</p>



<span id="example-requests-DELETEapi-upload-file">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/upload/file" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"path\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/upload/file"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "path": "architecto"
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-upload-file">
</span>
<span id="execution-results-DELETEapi-upload-file" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-upload-file"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-upload-file"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-upload-file" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-upload-file">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-upload-file" data-method="DELETE"
      data-path="api/upload/file"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-upload-file', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-upload-file"
                    onclick="tryItOut('DELETEapi-upload-file');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-upload-file"
                    onclick="cancelTryOut('DELETEapi-upload-file');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-upload-file"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/upload/file</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-upload-file"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-upload-file"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="path"                data-endpoint="DELETEapi-upload-file"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-upload-cover-image">Upload cover image for game (admin only)</h2>

<p>
</p>



<span id="example-requests-POSTapi-upload-cover-image">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/upload/cover-image" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"game_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/upload/cover-image"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "game_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-upload-cover-image">
</span>
<span id="execution-results-POSTapi-upload-cover-image" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-upload-cover-image"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-upload-cover-image"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-upload-cover-image" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-upload-cover-image">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-upload-cover-image" data-method="POST"
      data-path="api/upload/cover-image"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-upload-cover-image', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-upload-cover-image"
                    onclick="tryItOut('POSTapi-upload-cover-image');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-upload-cover-image"
                    onclick="cancelTryOut('POSTapi-upload-cover-image');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-upload-cover-image"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/upload/cover-image</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-upload-cover-image"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-upload-cover-image"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="POSTapi-upload-cover-image"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-upload-document">Upload document for book (admin only)</h2>

<p>
</p>



<span id="example-requests-POSTapi-upload-document">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/upload/document" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"book_id\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/upload/document"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "book_id": "architecto"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-upload-document">
</span>
<span id="execution-results-POSTapi-upload-document" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-upload-document"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-upload-document"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-upload-document" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-upload-document">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-upload-document" data-method="POST"
      data-path="api/upload/document"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-upload-document', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-upload-document"
                    onclick="tryItOut('POSTapi-upload-document');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-upload-document"
                    onclick="cancelTryOut('POSTapi-upload-document');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-upload-document"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/upload/document</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-upload-document"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-upload-document"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>book_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="book_id"                data-endpoint="POSTapi-upload-document"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the books table. Example: <code>architecto</code></p>
        </div>
        </form>

                    <h2 id="endpoints-GETapi-users">GET api/users</h2>

<p>
</p>



<span id="example-requests-GETapi-users">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/users" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/users"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-users">
    </span>
<span id="execution-results-GETapi-users" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-users"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-users"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-users" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-users">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-users" data-method="GET"
      data-path="api/users"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-users', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-users"
                    onclick="tryItOut('GETapi-users');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-users"
                    onclick="cancelTryOut('GETapi-users');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-users"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/users</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-users"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="endpoints-PUTapi-users--user-">PUT api/users/{user}</h2>

<p>
</p>



<span id="example-requests-PUTapi-users--user-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/users/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"architecto\",
    \"birth_date\": \"2025-06-26T00:35:44\",
    \"avatar_url\": \"http:\\/\\/www.bailey.biz\\/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html\",
    \"is_admin\": true,
    \"is_suspended\": true,
    \"password\": \"gxwmi\\/#iw\\/\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/users/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "architecto",
    "birth_date": "2025-06-26T00:35:44",
    "avatar_url": "http:\/\/www.bailey.biz\/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html",
    "is_admin": true,
    "is_suspended": true,
    "password": "gxwmi\/#iw\/"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-users--user-">
</span>
<span id="execution-results-PUTapi-users--user-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-users--user-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-users--user-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-users--user-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-users--user-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-users--user-" data-method="PUT"
      data-path="api/users/{user}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-users--user-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-users--user-"
                    onclick="tryItOut('PUTapi-users--user-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-users--user-"
                    onclick="cancelTryOut('PUTapi-users--user-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-users--user-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/users/{user}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-users--user-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-users--user-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user"                data-endpoint="PUTapi-users--user-"
               value="architecto"
               data-component="url">
    <br>
<p>The user. Example: <code>architecto</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="PUTapi-users--user-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-users--user-"
               value="architecto"
               data-component="body">
    <br>
<p>Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-users--user-"
               value=""
               data-component="body">
    <br>

        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="PUTapi-users--user-"
               value="2025-06-26T00:35:44"
               data-component="body">
    <br>
<p>O campo value deve ser uma data válida. Example: <code>2025-06-26T00:35:44</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="avatar_url"                data-endpoint="PUTapi-users--user-"
               value="http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html"
               data-component="body">
    <br>
<p>Example: <code>http://www.bailey.biz/quos-velit-et-fugiat-sunt-nihil-accusantium-harum.html</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_admin</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-users--user-" style="display: none">
            <input type="radio" name="is_admin"
                   value="true"
                   data-endpoint="PUTapi-users--user-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-users--user-" style="display: none">
            <input type="radio" name="is_admin"
                   value="false"
                   data-endpoint="PUTapi-users--user-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_suspended</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-users--user-" style="display: none">
            <input type="radio" name="is_suspended"
                   value="true"
                   data-endpoint="PUTapi-users--user-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-users--user-" style="display: none">
            <input type="radio" name="is_suspended"
                   value="false"
                   data-endpoint="PUTapi-users--user-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Example: <code>true</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-users--user-"
               value="gxwmi/#iw/"
               data-component="body">
    <br>
<p>O campo value deve ter pelo menos 8 caracteres. Example: <code>gxwmi/#iw/</code></p>
        </div>
        </form>

                    <h2 id="endpoints-POSTapi-users--user--suspend">POST api/users/{user}/suspend</h2>

<p>
</p>



<span id="example-requests-POSTapi-users--user--suspend">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/users/architecto/suspend" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/users/architecto/suspend"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-users--user--suspend">
</span>
<span id="execution-results-POSTapi-users--user--suspend" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-users--user--suspend"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-users--user--suspend"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-users--user--suspend" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-users--user--suspend">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-users--user--suspend" data-method="POST"
      data-path="api/users/{user}/suspend"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-users--user--suspend', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-users--user--suspend"
                    onclick="tryItOut('POSTapi-users--user--suspend');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-users--user--suspend"
                    onclick="cancelTryOut('POSTapi-users--user--suspend');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-users--user--suspend"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/users/{user}/suspend</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-users--user--suspend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-users--user--suspend"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user"                data-endpoint="POSTapi-users--user--suspend"
               value="architecto"
               data-component="url">
    <br>
<p>The user. Example: <code>architecto</code></p>
            </div>
                    </form>

                    <h2 id="endpoints-DELETEapi-users--user-">DELETE api/users/{user}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-users--user-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/users/architecto" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/users/architecto"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-users--user-">
</span>
<span id="execution-results-DELETEapi-users--user-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-users--user-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-users--user-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-users--user-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-users--user-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-users--user-" data-method="DELETE"
      data-path="api/users/{user}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-users--user-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-users--user-"
                    onclick="tryItOut('DELETEapi-users--user-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-users--user-"
                    onclick="cancelTryOut('DELETEapi-users--user-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-users--user-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/users/{user}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-users--user-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-users--user-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="user"                data-endpoint="DELETEapi-users--user-"
               value="architecto"
               data-component="url">
    <br>
<p>The user. Example: <code>architecto</code></p>
            </div>
                    </form>

                <h1 id="games">Games</h1>

    <p>APIs for managing tabletop RPG games</p>

                                <h2 id="games-GETapi-games">List games</h2>

<p>
</p>

<p>Retrieve a paginated list of active games available in the system.</p>

<span id="example-requests-GETapi-games">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/games?per_page=10&amp;name=Dungeons&amp;status=active&amp;sort=name&amp;direction=asc" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/games"
);

const params = {
    "per_page": "10",
    "name": "Dungeons",
    "status": "active",
    "sort": "name",
    "direction": "asc",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-games">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dungeons &amp; Dragons 5e&quot;,
            &quot;description&quot;: &quot;The latest edition of the world&#039;s greatest roleplaying game&quot;,
            &quot;version&quot;: &quot;5.0&quot;,
            &quot;cover_image_url&quot;: &quot;https://example.com/dnd5e-cover.jpg&quot;,
            &quot;is_active&quot;: true,
            &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;
        }
    ],
    &quot;meta&quot;: {
        &quot;current_page&quot;: 1,
        &quot;per_page&quot;: 15,
        &quot;total&quot;: 1
    },
    &quot;message&quot;: &quot;Games retrieved successfully&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-games" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-games"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-games"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-games" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-games">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-games" data-method="GET"
      data-path="api/games"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-games', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-games"
                    onclick="tryItOut('GETapi-games');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-games"
                    onclick="cancelTryOut('GETapi-games');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-games"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/games</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-games"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-games"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-games"
               value="10"
               data-component="query">
    <br>
<p>Number of items per page (default: 15). Example: <code>10</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="GETapi-games"
               value="Dungeons"
               data-component="query">
    <br>
<p>Filter by game name. Example: <code>Dungeons</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>status</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="status"                data-endpoint="GETapi-games"
               value="active"
               data-component="query">
    <br>
<p>Filter by status (active/inactive). Example: <code>active</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>sort</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="sort"                data-endpoint="GETapi-games"
               value="name"
               data-component="query">
    <br>
<p>Sort field (name, created_at, updated_at, version). Example: <code>name</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>direction</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="direction"                data-endpoint="GETapi-games"
               value="asc"
               data-component="query">
    <br>
<p>Sort direction (asc/desc). Example: <code>asc</code></p>
            </div>
                </form>

                    <h2 id="games-GETapi-games--game-">Get game details</h2>

<p>
</p>

<p>Retrieve detailed information about a specific game, including its books, races, and classes.</p>

<span id="example-requests-GETapi-games--game-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/games/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/games/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-games--game-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Dungeons &amp; Dragons 5e&quot;,
        &quot;description&quot;: &quot;The latest edition of the world&#039;s greatest roleplaying game&quot;,
        &quot;version&quot;: &quot;5.0&quot;,
        &quot;cover_image_url&quot;: &quot;https://example.com/dnd5e-cover.jpg&quot;,
        &quot;is_active&quot;: true,
        &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;books&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Player&#039;s Handbook&quot;,
                &quot;description&quot;: &quot;Core rules for players&quot;,
                &quot;document_url&quot;: &quot;https://example.com/phb.pdf&quot;
            }
        ],
        &quot;races&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Human&quot;,
                &quot;description&quot;: &quot;Versatile and ambitious&quot;
            }
        ],
        &quot;classes&quot;: [
            {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Fighter&quot;,
                &quot;description&quot;: &quot;Master of martial combat&quot;
            }
        ]
    },
    &quot;message&quot;: &quot;Game retrieved successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Game not found&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-games--game-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-games--game-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-games--game-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-games--game-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-games--game-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-games--game-" data-method="GET"
      data-path="api/games/{game}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-games--game-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-games--game-"
                    onclick="tryItOut('GETapi-games--game-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-games--game-"
                    onclick="cancelTryOut('GETapi-games--game-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-games--game-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/games/{game}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-games--game-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-games--game-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>game</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="game"                data-endpoint="GETapi-games--game-"
               value="1"
               data-component="url">
    <br>
<p>The game ID. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="games-POSTapi-games">Create game</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Create a new game. Requires admin privileges.</p>

<span id="example-requests-POSTapi-games">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/games" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Pathfinder 2e\",
    \"description\": \"A fantasy tabletop RPG\",
    \"version\": \"2.0\",
    \"cover_image_url\": \"https:\\/\\/example.com\\/cover.jpg\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/games"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Pathfinder 2e",
    "description": "A fantasy tabletop RPG",
    "version": "2.0",
    "cover_image_url": "https:\/\/example.com\/cover.jpg"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-games">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 2,
        &quot;name&quot;: &quot;Pathfinder 2e&quot;,
        &quot;description&quot;: &quot;A fantasy tabletop RPG&quot;,
        &quot;version&quot;: &quot;2.0&quot;,
        &quot;cover_image_url&quot;: &quot;https://example.com/cover.jpg&quot;,
        &quot;is_active&quot;: true,
        &quot;created_by&quot;: 1,
        &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;
    },
    &quot;message&quot;: &quot;Game created successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;name&quot;: [
            &quot;The name has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-games" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-games"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-games"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-games" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-games">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-games" data-method="POST"
      data-path="api/games"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-games', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-games"
                    onclick="tryItOut('POSTapi-games');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-games"
                    onclick="cancelTryOut('POSTapi-games');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-games"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/games</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-games"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-games"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-games"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-games"
               value="Pathfinder 2e"
               data-component="body">
    <br>
<p>The game name (must be unique). Example: <code>Pathfinder 2e</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-games"
               value="A fantasy tabletop RPG"
               data-component="body">
    <br>
<p>The game description. Example: <code>A fantasy tabletop RPG</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>version</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="version"                data-endpoint="POSTapi-games"
               value="2.0"
               data-component="body">
    <br>
<p>The game version. Example: <code>2.0</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_image_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cover_image_url"                data-endpoint="POSTapi-games"
               value="https://example.com/cover.jpg"
               data-component="body">
    <br>
<p>The game cover image URL. Example: <code>https://example.com/cover.jpg</code></p>
        </div>
        </form>

                    <h2 id="games-PUTapi-games--game-">Update game</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update an existing game. Requires admin privileges.</p>

<span id="example-requests-PUTapi-games--game-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/games/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"Dungeons &amp; Dragons 5.5e\",
    \"description\": \"Updated edition\",
    \"version\": \"5.5\",
    \"cover_image_url\": \"https:\\/\\/example.com\\/new-cover.jpg\",
    \"is_active\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/games/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "Dungeons &amp; Dragons 5.5e",
    "description": "Updated edition",
    "version": "5.5",
    "cover_image_url": "https:\/\/example.com\/new-cover.jpg",
    "is_active": true
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-games--game-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;name&quot;: &quot;Dungeons &amp; Dragons 5.5e&quot;,
        &quot;description&quot;: &quot;Updated edition&quot;,
        &quot;version&quot;: &quot;5.5&quot;,
        &quot;cover_image_url&quot;: &quot;https://example.com/new-cover.jpg&quot;,
        &quot;is_active&quot;: true,
        &quot;created_by&quot;: 1,
        &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-01T13:00:00.000000Z&quot;
    },
    &quot;message&quot;: &quot;Game updated successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-games--game-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-games--game-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-games--game-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-games--game-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-games--game-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-games--game-" data-method="PUT"
      data-path="api/games/{game}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-games--game-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-games--game-"
                    onclick="tryItOut('PUTapi-games--game-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-games--game-"
                    onclick="cancelTryOut('PUTapi-games--game-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-games--game-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/games/{game}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-games--game-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-games--game-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-games--game-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>game</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="game"                data-endpoint="PUTapi-games--game-"
               value="1"
               data-component="url">
    <br>
<p>The game ID. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-games--game-"
               value="Dungeons & Dragons 5.5e"
               data-component="body">
    <br>
<p>The game name (must be unique). Example: <code>Dungeons &amp; Dragons 5.5e</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-games--game-"
               value="Updated edition"
               data-component="body">
    <br>
<p>The game description. Example: <code>Updated edition</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>version</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="version"                data-endpoint="PUTapi-games--game-"
               value="5.5"
               data-component="body">
    <br>
<p>The game version. Example: <code>5.5</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>cover_image_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="cover_image_url"                data-endpoint="PUTapi-games--game-"
               value="https://example.com/new-cover.jpg"
               data-component="body">
    <br>
<p>The game cover image URL. Example: <code>https://example.com/new-cover.jpg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_active</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="PUTapi-games--game-" style="display: none">
            <input type="radio" name="is_active"
                   value="true"
                   data-endpoint="PUTapi-games--game-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-games--game-" style="display: none">
            <input type="radio" name="is_active"
                   value="false"
                   data-endpoint="PUTapi-games--game-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>The game active status. Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="games-DELETEapi-games--game-">Delete game</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Delete a game from the system. Requires admin privileges.</p>

<span id="example-requests-DELETEapi-games--game-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/games/1" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/games/1"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-games--game-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Game deleted successfully&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (403):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;This action is unauthorized.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Game not found.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-games--game-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-games--game-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-games--game-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-games--game-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-games--game-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-games--game-" data-method="DELETE"
      data-path="api/games/{game}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-games--game-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-games--game-"
                    onclick="tryItOut('DELETEapi-games--game-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-games--game-"
                    onclick="cancelTryOut('DELETEapi-games--game-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-games--game-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/games/{game}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-games--game-"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-games--game-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-games--game-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>game</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="game"                data-endpoint="DELETEapi-games--game-"
               value="1"
               data-component="url">
    <br>
<p>The game ID. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="health">Health</h1>

    <p>System health check endpoints</p>

                                <h2 id="health-GETapi-health">Health check</h2>

<p>
</p>

<p>Get the application health status and system information.</p>

<span id="example-requests-GETapi-health">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/health" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/health"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-health">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;app_name&quot;: &quot;TableSheet Backend&quot;,
        &quot;version&quot;: &quot;1.0.0&quot;,
        &quot;uptime&quot;: 123.45,
        &quot;status&quot;: &quot;healthy&quot;,
        &quot;timestamp&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;environment&quot;: &quot;production&quot;,
        &quot;debug&quot;: false
    },
    &quot;message&quot;: &quot;Application is healthy&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-health" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-health"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-health"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-health" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-health">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-health" data-method="GET"
      data-path="api/health"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-health', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-health"
                    onclick="tryItOut('GETapi-health');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-health"
                    onclick="cancelTryOut('GETapi-health');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-health"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/health</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-health"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-health"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="profile">Profile</h1>

    <p>APIs for managing user profile information</p>

                                <h2 id="profile-GETapi-profile">Get user profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retrieve the authenticated user's profile information.</p>

<span id="example-requests-GETapi-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;username&quot;: &quot;john_doe&quot;,
        &quot;name&quot;: &quot;John Doe&quot;,
        &quot;email&quot;: &quot;john@example.com&quot;,
        &quot;birth_date&quot;: &quot;1990-01-01&quot;,
        &quot;avatar_url&quot;: &quot;https://example.com/avatar.jpg&quot;,
        &quot;is_admin&quot;: false,
        &quot;is_suspended&quot;: false,
        &quot;email_verified_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-profile" data-method="GET"
      data-path="api/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-profile"
                    onclick="tryItOut('GETapi-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-profile"
                    onclick="cancelTryOut('GETapi-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-profile"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="profile-PUTapi-profile">Update user profile</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Update the authenticated user's profile information.</p>

<span id="example-requests-PUTapi-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/profile" \
    --header "Authorization: Bearer {YOUR_AUTH_KEY}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"john_doe_updated\",
    \"name\": \"John Doe Updated\",
    \"email\": \"john.updated@example.com\",
    \"birth_date\": \"1990-01-01\",
    \"avatar_url\": \"https:\\/\\/example.com\\/new-avatar.jpg\",
    \"password\": \"newpassword123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/profile"
);

const headers = {
    "Authorization": "Bearer {YOUR_AUTH_KEY}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "john_doe_updated",
    "name": "John Doe Updated",
    "email": "john.updated@example.com",
    "birth_date": "1990-01-01",
    "avatar_url": "https:\/\/example.com\/new-avatar.jpg",
    "password": "newpassword123"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Profile updated successfully&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;username&quot;: &quot;john_doe_updated&quot;,
        &quot;name&quot;: &quot;John Doe Updated&quot;,
        &quot;email&quot;: &quot;john.updated@example.com&quot;,
        &quot;birth_date&quot;: &quot;1990-01-01&quot;,
        &quot;avatar_url&quot;: &quot;https://example.com/new-avatar.jpg&quot;,
        &quot;is_admin&quot;: false,
        &quot;is_suspended&quot;: false,
        &quot;email_verified_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;created_at&quot;: &quot;2024-01-01T12:00:00.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2024-01-01T13:00:00.000000Z&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;The given data was invalid.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;The email has already been taken.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-profile" data-method="PUT"
      data-path="api/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-profile"
                    onclick="tryItOut('PUTapi-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-profile"
                    onclick="cancelTryOut('PUTapi-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-profile"
               value="Bearer {YOUR_AUTH_KEY}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {YOUR_AUTH_KEY}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="PUTapi-profile"
               value="john_doe_updated"
               data-component="body">
    <br>
<p>The unique username. Example: <code>john_doe_updated</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-profile"
               value="John Doe Updated"
               data-component="body">
    <br>
<p>The user's full name. Example: <code>John Doe Updated</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-profile"
               value="john.updated@example.com"
               data-component="body">
    <br>
<p>The user's email address. Example: <code>john.updated@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>birth_date</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="birth_date"                data-endpoint="PUTapi-profile"
               value="1990-01-01"
               data-component="body">
    <br>
<p>The user's birth date (YYYY-MM-DD). Example: <code>1990-01-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>avatar_url</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="avatar_url"                data-endpoint="PUTapi-profile"
               value="https://example.com/new-avatar.jpg"
               data-component="body">
    <br>
<p>The user's avatar URL. Example: <code>https://example.com/new-avatar.jpg</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="PUTapi-profile"
               value="newpassword123"
               data-component="body">
    <br>
<p>The new password (min 8 characters). Example: <code>newpassword123</code></p>
        </div>
        </form>

                <h1 id="races">Races</h1>

    <p>APIs for managing tabletop RPG races</p>

                                <h2 id="races-GETapi-races">GET api/races</h2>

<p>
</p>



<span id="example-requests-GETapi-races">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/races" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/races"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-races">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://host.docker.internal:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Human&quot;,
            &quot;description&quot;: &quot;Versatile and ambitious, humans are the most common race in most fantasy worlds.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 2,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Elf&quot;,
            &quot;description&quot;: &quot;Magical people of otherworldly grace, living in places of ethereal beauty.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 3,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Dwarf&quot;,
            &quot;description&quot;: &quot;Bold and hardy, dwarves are known as skilled warriors, miners, and workers of stone and metal.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 4,
            &quot;game_id&quot;: 1,
            &quot;name&quot;: &quot;Halfling&quot;,
            &quot;description&quot;: &quot;Small folk who love peace, good food, hearth and home.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 1,
                &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
                &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
                &quot;version&quot;: &quot;5.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 5,
            &quot;game_id&quot;: 2,
            &quot;name&quot;: &quot;Human&quot;,
            &quot;description&quot;: &quot;Ambitious, sometimes heroic, and always confident, humans have an ability to work together toward common goals.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Pathfinder 2nd Edition&quot;,
                &quot;description&quot;: &quot;A fantasy tabletop roleplaying game where players take on the role of brave adventurers fighting to survive in a world beset by magic and evil.&quot;,
                &quot;version&quot;: &quot;2.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        },
        {
            &quot;id&quot;: 6,
            &quot;game_id&quot;: 2,
            &quot;name&quot;: &quot;Elf&quot;,
            &quot;description&quot;: &quot;As an ancient people, elves have seen great change and have the perspective that can come only from watching the arc of history.&quot;,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null,
            &quot;game&quot;: {
                &quot;id&quot;: 2,
                &quot;name&quot;: &quot;Pathfinder 2nd Edition&quot;,
                &quot;description&quot;: &quot;A fantasy tabletop roleplaying game where players take on the role of brave adventurers fighting to survive in a world beset by magic and evil.&quot;,
                &quot;version&quot;: &quot;2.0&quot;,
                &quot;cover_image_url&quot;: null,
                &quot;is_active&quot;: true,
                &quot;created_by&quot;: 1,
                &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
                &quot;deleted_at&quot;: null
            }
        }
    ],
    &quot;message&quot;: &quot;Races retrieved successfully&quot;,
    &quot;meta&quot;: {
        &quot;pagination&quot;: {
            &quot;current_page&quot;: 1,
            &quot;last_page&quot;: 1,
            &quot;per_page&quot;: 15,
            &quot;total&quot;: 6,
            &quot;from&quot;: 1,
            &quot;to&quot;: 6,
            &quot;has_more_pages&quot;: false,
            &quot;links&quot;: {
                &quot;first&quot;: &quot;http://host.docker.internal/api/races?page=1&quot;,
                &quot;last&quot;: &quot;http://host.docker.internal/api/races?page=1&quot;,
                &quot;prev&quot;: null,
                &quot;next&quot;: null
            }
        }
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-races" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-races"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-races"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-races" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-races">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-races" data-method="GET"
      data-path="api/races"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-races', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-races"
                    onclick="tryItOut('GETapi-races');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-races"
                    onclick="cancelTryOut('GETapi-races');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-races"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/races</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-races"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-races"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="races-GETapi-races--race-">GET api/races/{race}</h2>

<p>
</p>



<span id="example-requests-GETapi-races--race-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://host.docker.internal/api/races/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/races/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-races--race-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: http://host.docker.internal:8000
access-control-allow-credentials: true
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;game_id&quot;: 1,
        &quot;name&quot;: &quot;Human&quot;,
        &quot;description&quot;: &quot;Versatile and ambitious, humans are the most common race in most fantasy worlds.&quot;,
        &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
        &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
        &quot;deleted_at&quot;: null,
        &quot;game&quot;: {
            &quot;id&quot;: 1,
            &quot;name&quot;: &quot;Dungeons &amp; Dragons 5th Edition&quot;,
            &quot;description&quot;: &quot;The world&#039;s greatest roleplaying game. Create heroic characters and embark on epic adventures in a fantasy world of magic and monsters.&quot;,
            &quot;version&quot;: &quot;5.0&quot;,
            &quot;cover_image_url&quot;: null,
            &quot;is_active&quot;: true,
            &quot;created_by&quot;: 1,
            &quot;created_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;updated_at&quot;: &quot;2025-06-26T00:35:39.000000Z&quot;,
            &quot;deleted_at&quot;: null
        }
    },
    &quot;message&quot;: &quot;Ra&ccedil;a recuperada com sucesso&quot;,
    &quot;meta&quot;: null
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-races--race-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-races--race-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-races--race-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-races--race-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-races--race-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-races--race-" data-method="GET"
      data-path="api/races/{race}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-races--race-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-races--race-"
                    onclick="tryItOut('GETapi-races--race-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-races--race-"
                    onclick="cancelTryOut('GETapi-races--race-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-races--race-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/races/{race}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-races--race-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-races--race-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>race</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="race"                data-endpoint="GETapi-races--race-"
               value="1"
               data-component="url">
    <br>
<p>The race. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="races-POSTapi-races">POST api/races</h2>

<p>
</p>



<span id="example-requests-POSTapi-races">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://host.docker.internal/api/races" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"game_id\": \"architecto\",
    \"name\": \"n\",
    \"description\": \"Eius et animi quos velit et.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/races"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "game_id": "architecto",
    "name": "n",
    "description": "Eius et animi quos velit et."
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-races">
</span>
<span id="execution-results-POSTapi-races" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-races"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-races"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-races" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-races">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-races" data-method="POST"
      data-path="api/races"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-races', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-races"
                    onclick="tryItOut('POSTapi-races');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-races"
                    onclick="cancelTryOut('POSTapi-races');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-races"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/races</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-races"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-races"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="POSTapi-races"
               value="architecto"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTapi-races"
               value="n"
               data-component="body">
    <br>
<p>O campo value não pode ser maior que 255 caracteres. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-races"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
        </form>

                    <h2 id="races-PUTapi-races--race-">PUT api/races/{race}</h2>

<p>
</p>



<span id="example-requests-PUTapi-races--race-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://host.docker.internal/api/races/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"name\": \"b\",
    \"description\": \"Eius et animi quos velit et.\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/races/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "b",
    "description": "Eius et animi quos velit et."
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-races--race-">
</span>
<span id="execution-results-PUTapi-races--race-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-races--race-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-races--race-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-races--race-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-races--race-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-races--race-" data-method="PUT"
      data-path="api/races/{race}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-races--race-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-races--race-"
                    onclick="tryItOut('PUTapi-races--race-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-races--race-"
                    onclick="cancelTryOut('PUTapi-races--race-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-races--race-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/races/{race}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-races--race-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-races--race-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>race</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="race"                data-endpoint="PUTapi-races--race-"
               value="1"
               data-component="url">
    <br>
<p>The race. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>game_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="game_id"                data-endpoint="PUTapi-races--race-"
               value=""
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the games table.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="PUTapi-races--race-"
               value="b"
               data-component="body">
    <br>
<p>O campo value não pode ser maior que 255 caracteres. Example: <code>b</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-races--race-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
        </form>

                    <h2 id="races-DELETEapi-races--race-">DELETE api/races/{race}</h2>

<p>
</p>



<span id="example-requests-DELETEapi-races--race-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://host.docker.internal/api/races/1" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://host.docker.internal/api/races/1"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-races--race-">
</span>
<span id="execution-results-DELETEapi-races--race-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-races--race-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-races--race-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-races--race-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-races--race-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-races--race-" data-method="DELETE"
      data-path="api/races/{race}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-races--race-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-races--race-"
                    onclick="tryItOut('DELETEapi-races--race-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-races--race-"
                    onclick="cancelTryOut('DELETEapi-races--race-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-races--race-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/races/{race}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-races--race-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-races--race-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>race</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="race"                data-endpoint="DELETEapi-races--race-"
               value="1"
               data-component="url">
    <br>
<p>The race. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
