# SWE40006 – Deployment Portfolio Task 3: Cloud Application Deployment & Infrastructure Scaling on AWS

**Student:** Sahil
**Student ID:** 105295665
**Unit:** SWE40006 – Software Deployment and Evolution
**Semester:** 2026, Semester 2
**Declared Target Level:** Sub-task 3.4 – High Distinction (HD)

This repository contains supporting configuration templates and documentation for a WordPress deployment on AWS, progressing through Pass, Credit, Distinction, and High Distinction levels. Full step-by-step evidence, annotated screenshots, and the self-troubleshooting log are included in the submitted report (PDF/DOCX), not in this repository, per the assignment's submission guidelines.

## Live Verification

- **Application Load Balancer DNS:** http://wordpress-alb-1341490122.ap-southeast-2.elb.amazonaws.com
- **Original EC2 Public IP (Pass level):** http://3.25.186.175

## Architecture Summary

```
Internet
   │
   ▼
Application Load Balancer (2 Availability Zones)
   │
   ▼
Auto Scaling Group (min 2 / max 4 EC2 instances, from custom AMI)
   │
   ▼
Amazon RDS – MariaDB (private subnet, TLS-enforced)

Supporting services:
- Amazon S3        → manual backup of WordPress application files
- CloudWatch + SNS → CPU utilization alarm (>70%) with email notification
- AWS Systems Manager (SSM) → keyless Session Manager access to EC2 instances
```

## Task Levels Completed

| Level | Summary |
|---|---|
| **Pass (3.1)** | EC2 instance (Amazon Linux 2023) launched with Security Group allowing HTTP/HTTPS/SSH; WordPress/LAMP stack installed directly on EC2; verified via public IPv4. |
| **Credit (3.2)** | Database decoupled to Amazon RDS (MariaDB) over TLS; `wordpressdb` and `wp_` tables migrated; WordPress reconfigured to use the RDS endpoint. Manual backup of `/var/www/html` archived and uploaded to Amazon S3 (bucket: `swe40006-sahil-wordpress-backup-2026`); restore to EC2 verified via AWS CLI. |
| **Distinction (3.3)** | Custom AMI built from the working WordPress instance; EC2 Launch Template created; Application Load Balancer provisioned across 2 Availability Zones; Auto Scaling Group (2 min / 4 max) attached to ALB target group. |
| **High Distinction (3.4)** | CloudWatch Alarm on CPUUtilization (>70%) wired to an SNS topic with email subscription; IAM role with `AmazonSSMManagedInstanceCore` attached via Launch Template update and Instance Refresh; SSM Session Manager verified for keyless terminal access. |

## IAM Roles Used

- **EC2-S3-Backup-Role** – AWS-managed policy `AmazonS3ReadOnlyAccess`, attached to EC2 for restoring backups from S3.
- **EC2-SSM-Role** – AWS-managed policy `AmazonSSMManagedInstanceCore`, attached via Launch Template for Session Manager access.

## Repository Contents

- `wp-config-template.php` – Redacted WordPress configuration file. All database credentials and authentication salts have been replaced with placeholders. **Do not use these placeholder values in a real deployment** — generate your own secrets via the [WordPress.org secret-key service](https://api.wordpress.org/secret-key/1.1/salt/).
- `README.md` – This file.

## Security Note

No private keys, database dumps, real credentials, or the full WordPress application archive are stored in this repository, in line with the assignment's submission guidelines. Full evidence (screenshots of RDS configuration, S3 bucket contents, ALB/ASG health, CloudWatch alarms, and SSM sessions) is provided in the submitted report.

## Self-Troubleshooting Highlights

Full details are documented in the report (Section 6). Key issues resolved independently:

1. RDS rejected unencrypted connections (error 3159) — resolved by using the AWS regional TLS certificate bundle.
2. SCP transfer failed due to incorrect key filename/path — resolved by locating the correct `.pem` file and working directory.
3. EC2 could not authenticate to S3 (`Unable to locate credentials`) — resolved by attaching an IAM role with S3 read access.
4. Auto Scaling Group instances launched before the SSM IAM role was attached did not have Session Manager access — resolved via Launch Template version update and an Instance Refresh.
