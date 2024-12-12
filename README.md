Delivery Management System

Overview

The Delivery Management System is a Laravel application designed for managing deliveries, dispatchers, drivers, and orders. It also integrates with external platforms such as Shopify for importing orders. The system is built with Laravel and FilamentPHP for efficient and user-friendly management.

Features

General Features
•	Manage deliveries, dispatchers, drivers, and orders.
•	Integrate with Shopify and other platforms.
•	Import orders using the Shopify API.
•	Relational data management between deliveries and orders.

Key Resources
•	Deliveries: Track delivery records and their association with orders.
•	Delivery Updates: Record updates on delivery statuses.
•	Dispatchers: Manage dispatchers responsible for assigning deliveries.
•	Drivers: Manage drivers responsible for executing deliveries.
•	Orders: Import and manage orders from platforms like Shopify.
•	Integrations: Connect with external platforms for data synchronization.

Setup Instructions

Prerequisites
•	PHP 8.2 or higher.
•	Composer installed.
•	MySQL or equivalent database.

Installation
1.	Clone the repository.

git clone <repository-url>
cd delivery-system


	2.	Install dependencies.

composer install


	3.	Set up the environment file.

cp .env.example .env

Configure database and other environment settings in .env.

	4.	Run migrations and seed the database.

php artisan migrate --seed


	5.	Start the local development server.

php artisan serve

Detailed Features

Deliveries

Manage deliveries and associate them with orders.

Fields:
•	Title
•	Status
•	Associated Order (nullable)

Filament Features:
•	Create, edit, and delete deliveries.
•	View deliveries in a tabular format.
•	Select an associated order during creation or editing.

Relationship:

Each delivery can optionally be linked to an order.

Delivery Updates

Track the progress and statuses of deliveries.

Fields:
•	Delivery ID
•	Status
•	Description
•	Updated At

Filament Features:
•	Record updates for each delivery.
•	Filter and view updates by status or delivery.

Dispatchers

Manage dispatchers who assign and oversee deliveries.

Fields:
•	Name
•	Email
•	Phone

Filament Features:
•	Add, edit, and delete dispatchers.
•	View a list of dispatchers in a tabular format.

Drivers

Manage drivers who fulfill deliveries.

Fields:
•	Name
•	Email
•	Phone
•	Assigned Deliveries

Filament Features:
•	Assign deliveries to drivers.
•	Manage driver details and view their assigned deliveries.

Orders

Manage and import orders from platforms like Shopify.

Fields:
•	Integration ID
•	External Order ID
•	Customer Name
•	Customer Email
•	Total Amount
•	Status
•	Placed At

Filament Features:
•	View and manage imported orders.
•	Associate orders with deliveries.

Integration:

Orders are imported using the OrderImportHandler job, which invokes the ShopifyOrderImportService.

Integrations

Connect external platforms for importing orders.

Fields:
•	Type (e.g., Shopify)
•	API Key
•	Access Token
•	Shop Domain

Filament Features:
•	Add or edit integrations.
•	Display a “Connect Shopify” button on the integration edit page for Shopify type integrations.
•	Import orders directly from Shopify by clicking “Import Orders” on the edit page.

Workflow

Integration with Shopify
1.	Add an integration with type = Shopify and provide the necessary credentials.
2.	Click “Connect Shopify” on the integration edit page to complete the OAuth process.
3.	After connecting, click “Import Orders” to fetch orders from Shopify.

Order-Delivery Relationship
•	Orders can be associated with deliveries using the order_id field in the deliveries table.
•	Deliveries can reference orders for tracking purposes.

Code Overview

OrderImportHandler

Handles importing orders. It uses the ShopifyOrderImportService to fetch orders from Shopify and save them in the database.

Code Workflow:
1.	Fetch orders from the Shopify API.
2.	Map the order data using ShopifyOrderMapper.
3.	Store or update orders in the database.

ShopifyOrderImportService

Responsible for making API calls to Shopify, fetching orders, and mapping them for storage.

IntegrationController

Handles actions related to integrations, including Shopify OAuth redirection and callback handling.

Testing
1.	Run the test suite:

php artisan test


	2.	Verify the following:
	•	Database migrations and seeders.
	•	CRUD operations for all resources.
	•	Shopify integration (connect and import orders).

Notes
•	Make sure to configure the queue driver for handling jobs.
•	Use the Import Orders button only after successfully connecting Shopify.
