export AWS_EB_PROFILE=contrib-kh-admin
aws sts get-caller-identity --output text --query "Arn"
#do initial work in us-east-2. The AMI will not transfer to us-west-2.

eb list --verbose

cd ~/git/dbp-phoenix
eb create
-- select default
-- select default 
-- select 2 for application load balancer

eb status --verbose

# open the web app associated with this beanstalk
eb open

#bring it down
eb terminate