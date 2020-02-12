base infrastructure (ok to add to phoenix while in default VPC)
- configure php (php.config)
- add / configure composer
- configure artisan (artisan.config)

Create via terraform
- custom VPC
- RDS
- Elasticache subnet group
- certificates

After Terraform
- deploy beanstalk to custom VPC
- add elasticache (memcached. note this requires reference to custom vpc id and elasticache subnet group)


# did beanstalk create the keypair?
DBP app
- configure env 
    (NOTE: env.config has references to Fostermade S3! this is likely a problem)
    the private and public key files are hardcoded in env.config. need to figure out how to automate key creation and population in S3 bucket

