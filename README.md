##SSCP
<hr>
<b>Description: </b>ShipStation to ControlPad integration<br> 
<b>By: </b>Chad Clites<br>
<b>Email: </b><a a href="mailto:chad@extant.digital">chad@extant.digital</a><br>
<b>Slack: </b>extantdigital.slack.com<br><br> 

Document revision date: 08/26/2020<br>

<hr>

#####Requirements
PHP 7.2 or greater

<hr>

#####Installation

<hr>

#####SSCP Operation

<i>ControlPad to ShipStation Conversion</i>
<ul>
    <li>Cron job runs artisan cron:process-cp-to-ss</li>
    <li>SSCP pulls orders by API key.</li>
    <li>ControlPad order data is transformed into ShipStation order data</li>
    <li>Orders are entered into ShipStation</li>
    <li>Update ControlPad orders to Pending</li>
</ul>
<br>
<i>ShipStation Shipping Notification</i>
<ul>
    <li>When an order is marked as shipped, ShipStation hits the SSCP api endpoint.</li>
    <li>SSCP updates the status of the related CP order to Fulfilled</li>
</ul>

<hr>

#####General Development Notes:

SSCP is unusual in that instead of running off a database like a conventional web app, but rather acts as a translation layer between ControlPad and ShipStation. There are no model 'relationships' between SS and CP like would normally exist.

<i>App\DataModels</i>

Since there are no DB objects representing CP orders or SS orders, the orders are mocked out in:
- App\DataModels\ControlPadDataModel
- App\DataModels\ShipStationDataModel

These two files contain outgoing Api calls.

App\BaseDataModel is responsible for determining whether production or debugging credentials should be used.

<i>Controllers</i>

Only one controller is in use - ShipStationController. It handles any notifications from ShipStation, such as when an order is marked as shipped.

<i>Resources</i>

SSCP uses ControlPadResource and ShipStationResouce to transform order data from one type to another. When sending an order to SS, ControlPadResource is used to convert the data to a SS representation.

<i>Models</i>

Models are used to create data necessary for transmission via API, such as headers, or encrypting authentication tokens.

<i>Configs</i>

Sscp.php currently holds endpoints and authentication data for API providers.

Logging.php holds configuration information for Rollbar.

Database.php holds configs for cache storage.

Auths.php holds user API tokens

<i>Jobs</i>

The job classes for ShipStation and ControlPad queues are unused for the moment until testing indicates otherwise. They are stubbed in and ready to go if needed.
<hr> 

#####Operational Notes:

User authentications are loaded from auths config. When the Cron runs, it looks for an array of users users in auths config, and processes each user.

<hr>

#####DEVELOPER UPDATES
08/26/2020

<i>Credentials</i>

To support multi-tenency and multiple APIs, config/auths.php was modified to allow mamangement of multiple shippers.

Should the need arise, the app can simply be cloned to handle a single client.

<i>Crons</i>

Each integration has their own cron job.

<i>Code Reorganization</i>

Code base has been reorganized to use repository and transformer patterns. This will make it easier to establish a point-by-point checklist for quickly integrating new providers.

<i>Dependencies</i>
There are no new dependencies in this update.







