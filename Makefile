start:
	docker-compose up -d

stop:
	docker-compose down

migrate:
	@printf "$(grn)\n Migrating data...$(end)\n"
	@docker-compose exec php php artisan migrate

create-migration:
	docker-compose exec php php artisan make:migration $(filter-out $@,$(MAKECMDGOALS))

create-seeder:
	docker-compose exec php php artisan make:seeder $(filter-out $@,$(MAKECMDGOALS))

seed:
	docker-compose exec php php artisan db:seed

redis:
	docker-compose exec -it redis redis-cli -a $(filter-out $@,$(MAKECMDGOALS))