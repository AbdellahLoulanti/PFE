# ENSA Tetouan Association Platform

A modern web application built for associations to manage their online presence, blog posts, events, and member communications. Built with Laravel 12, Livewire 3, and Filament 3.

## Project Overview

This platform provides associations with powerful tools to:

- Manage and publish blog posts
- Create and organize events
- Handle user permissions and roles
- Send automated newsletters for new content
- Manage basic pages (Welcome, Blog, Events, Contact)

### Tech Stack

- Laravel 12 (PHP Framework)
- Livewire 3 (Full-stack Framework)
- Filament 3 (Admin Panel)
- MySQL (Database)
- TailwindCSS (Styling)

## Features

### Content Management

- Blog post creation and management
- Event organization and scheduling
- Newsletter system with automated sending
- Media management for posts and events

### User Management

- Role-based access control
- User registration and authentication
- Admin dashboard for user management

### Communication

- Newsletter subscription system
- Automated notifications for new content
- Contact form functionality

## Project Setup and Development Guide

### Prerequisites

- PHP 8.4+
- Composer
- Node.js & npm
- MySQL
- Git

### Local Development Setup

1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Configure database settings in `.env`
5. Run `php artisan key:generate`
6. Run migrations: `php artisan migrate`
7. Install frontend dependencies: `npm install`
8. Start development server: `php artisan serve`
9. In a new terminal: `npm run dev`

## Todo List and Task Distribution

### Initial Setup Phase (Both Interns)

1. Set up local development environment
2. Learn Git basics and GitHub basic (Pull requests)
3. Review Laravel, Livewire, and Filament documentation

### Intern 1 Tasks (Frontend & User Management)

1. User Interface Development
   - [ ] Design and implement welcome page
   - [ ] Create blog listing page
   - [ ] Build events page
   - [ ] Develop contact page
   - [ ] Implement responsive navigation

2. User Management
   - [ ] Set up authentication system
   - [ ] Implement user registration
   - [ ] Create user profile management
   - [ ] Design and implement role management UI

### Intern 2 Tasks (Backend & Content Management)

1. Content Management System
   - [ ] Implement blog post CRUD operations
   - [ ] Create event management system
   - [ ] Set up media upload functionality
   - [ ] Implement post categories and tags

2. Newsletter System
   - [ ] Create newsletter subscription system
   - [ ] Implement automated email notifications
   - [ ] Design email templates
   - [ ] Set up queue system for emails

### Collaboration Guidelines

1. Always create feature branches from main
2. Use meaningful commit messages
3. Create detailed pull requests with descriptions
4. Review each other's code
5. Maintain regular communication
6. Update README as needed

### Git Workflow

1. Create a new branch for each feature

   ```bash
   git checkout -b feature/your-feature-name
   ```

2. Make your changes and commit

   ```bash
   git add .
   git commit -m "Descriptive message"
   ```

3. Push to GitHub

   ```bash
   git push origin feature/your-feature-name
   ```

4. Create a Pull Request on GitHub
5. Wait for review and merge
