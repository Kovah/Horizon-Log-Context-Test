# Laravel Queue Log Context Test

See [TestLoggingCommand.php](./app/Console/Commands/TestLoggingCommand.php) and [TestLoggingJob.php](./app/Jobs/TestLoggingJob.php) for details.

```bash
# Install dependencies
composer install
php artisan horizon:install

# Start a redis locally
docker compose up -d

# Start Horizon
php artisan horizon
# or start processing queues directly via
php artisan queue:work

# in a new terminal, run the logging test command
php artisan logging:test
```

The `storage/logs/laravel.log` should contain something like this:
```
[2024-01-05 13:18:54] local.DEBUG: Logging Test in command {"trace_id":"01HKCWDM76BHAH7BXFT3DH3C1K","type":"debugging"} 
[2024-01-05 13:18:54] local.DEBUG: Logging Test in command with manual Trace ID {"trace_id":"01HKCWDM9S7X34GK4S3JGMW8GE","type":"debugging"} 
[2024-01-05 13:18:56] local.DEBUG: Logging Test in job {"type":"debugging"} 
[2024-01-05 13:18:56] local.DEBUG: Logging Test in job with manual Trace ID {"trace_id":"01HKCWDM9S7X34GK4S3JGMW8GE","type":"debugging"} 
```
