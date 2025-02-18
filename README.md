## Laravel Documentation

### Overview
This documentation provides information about the implementation of New Aggregator and run it using Laravel's scheduler.

### Step to Setup
1. Clone the repository:
`git clone https://github.com/bhimbho/new-aggregator.git`
2. Install dependencies:
3. For Docker users, I have added laravel sail to the project.
run `sail up build` then `sail up -d`
4. copy .env.example to .env
`cp .env.example .env`
5. Generate an application key:
`sail artisan key:generate` or `php artisan key:generate`
6. Run database migrations:
`sail artisan migrate` or `php artisan migrate`
5. Insert Api Keys for the news platform in the env file, then run
`sail artisan scheduler:run`
Note: the command has been configured to run every 6hours, you can adjust according to your preference and data size

### For cron-tab job use:
`* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1`


### API Documentation
##### Get Articles
- **Endpoint:** `/api/articles`
- **Method:** `GET`
- **Description:** Retrieve a list of articles.
- **Parameters:**
  - `page` (optional): The page number for pagination.
  - `per_page` (optional): The number of articles per page.
  - `sort_by` (optional): The field to sort the articles by.
  - `sort_order` (optional): The sorting order (asc or desc).
  - `category` (optional): The category of the articles.
  - `search` (optional): Search query for filtering articles (`title`, `description`, `content`).
  - `source` (optional): Filter articles by source (`news api`, `guardian`, `new york times`).

  **Response:**
  - `success`: Indicates whether the request was successful.
  - `data`: An array of article objects.
  - `meta`: Pagination information.
  - `message`: Article retrieved successfully.
  - `status`: HTTP status.


