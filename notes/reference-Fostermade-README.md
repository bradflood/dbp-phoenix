# FCBH DBP Infrastructure



This repository contains [Terraform](https://www.terraform.io/) configuration files for managing the base infrastructure required for supporting three primary Elastic Beanstalk environments. These environments can be brought up and torn down without affecting the base infrastructure.



## S3 Backend
Terraform is configured to save its state remotely to S3. Additionally, to prevent a corrupted state, a state lock is saved to a DynamoDB table while Terraform applies changes. Both the S3 bucket (terraform-state-fcbh-us-west-2) and the DynamoDB table (terraform-state-lock) are not managed in Terraform — they are the only significant resources that must be created by other means, either via the AWS CLI or in the console.
## Resources in the Base infrastructure

The base infrastructure includes the following resources:

* A custom (non-default) VPC with three public subnets, three private subnets, a NAT gateway and corresponding routing tables.

* A bastion host for accessing resources on the private subnets.

* An ElastiCache subnet group so ElastiCache instances can be created in the custom VPC.

* An RDS subnet group so RDS instances can be created in the custom VPC. 
* An RDS Aurora cluster with one writer and one reader instance for DBP user data.

* An RDS security group that allows ingress to the DBP user database from EC2 instances inside Elastic Beanstalk environments.

* Certificate validation for v4.dbt.io, staging.v4.dbt.io, dev.v4.dbt.io, live.bible.is, staging.live.bible.is and dev.live.bible.is.*

\* A note on certificate validation: As noted in the [documentation for aws_acm_certificate_validation](https://www.terraform.io/docs/providers/aws/r/acm_certificate_validation.html), a certificate validation resource “implements part of the validation workflow. It does not represent a real-world entity in AWS.” As part of this workflow, the DNS records that are required for certificate validation are created hosted zones in Route 53 for bible.is and dbt.io. However, these records are not actually in effect, as the public name servers for bible.is and dbt.io are elsewhere.



---- BWF additional notes ---
1) s3 
#copy from fostermade S3 to target account S3
aws --profile fostermade       s3 cp s3://elasticbeanstalk-us-west-2-509573027517/dbp-api/env ~/git/dbp-phoenix/notes 
aws --profile fostermade       s3 cp s3://elasticbeanstalk-us-west-2-509573027517/dbp-api/private.pem ~/git/dbp-phoenix/notes 
aws --profile fostermade       s3 cp s3://elasticbeanstalk-us-west-2-509573027517/dbp-api/public.pem  ~/git/dbp-phoenix/notes 

# dev-account-1
aws --profile contrib-kh-admin s3 cp  ~/git/dbp-phoenix/notes/env          s3://elasticbeanstalk-us-east-2-627672411722/dbp-phoenix/dbp-api/env 
aws --profile contrib-kh-admin s3 cp  ~/git/dbp-phoenix/notes/private.pem  s3://elasticbeanstalk-us-east-2-627672411722/dbp-phoenix/dbp-api/private.pem
aws --profile contrib-kh-admin s3 cp  ~/git/dbp-phoenix/notes/public.pem   s3://elasticbeanstalk-us-east-2-627672411722/dbp-phoenix/dbp-api/public.pem



    potential changes required
        AWS_ARN_ROLE=arn:aws:iam::869054869504:role/api-node
        several AWS Secrets, which may need to move to DBP account
