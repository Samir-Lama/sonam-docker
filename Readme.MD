Commands to execute
docker exec <container name> php artisan key:generate
docker exec <container name> php artisan migrate:fresh --seed
docker exec <container name> php artisan storage:link