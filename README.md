# GitFormed

This repository contains the source code for the MVP (Minimum Viable Product) of the project, enabling users to perform core functionalities related to repositories and pull requests. Below are instructions on how to set up and run both the backend and frontend components.

## Setup and Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/sayd17/GitFormed.git
   ```
2. **Install Composer**

3. **Use Vite to setup React environment**

## Database

![alt text](https://github.com/sayd17/GitFormed/blob/master/dbdiagram.svg)

## Core Functionalities

#### Authentication

- Users can log in to their accounts using email and password.

#### Repositories

- Guests/users can view a list of existing repositories.
- Guests/users can sort the repository list alphabetically, by the latest, or by the number of watchers.
- Users can view a list of their repositories.
- Users can see a list of repositories they are watching, with a limit of 10 repositories displayed at a time.
- For each repository, the display includes the username/repository_name, number of watchers, and the date and time of creation.

#### Create Repository

- Users can create a new repository with a unique name matching the pattern [A-Za-z0-9-_]{5,10}.
  Pull Request
- Repository owners can create a new pull request with a specified title.
- Repository owners can view a list of pull requests, displaying the id, title, and time of creation.

#### Watch Repository

- Users can add themselves as watchers to an existing repository.
- Watchers are notified when a pull request is created in the repository.

## Technologies Used

- Laravel
- React

## 🔗 My LinkedIn Profile

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/abu-sayeed1)
