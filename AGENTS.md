# AI Agent Instructions for UTeM Helpdesk System

This file (`AGENTS.md`) contains specific rules and conventions that **MUST** be followed by any AI agent (such as Jules) working on this repository. Read and obey these instructions before modifying or adding any code.

## 1. Language Conventions (Bahasa / Pengekodan)
To maintain a professional codebase while remaining accessible to local developers, follow a strict language separation:
*   **Code in English:** ALL programmatic elements must be written in English. This includes variable names, function/method names, class names, database table names, and column names.
    *   *Correct:* `$ticketStatus`, `getUserTickets()`, `departments` table.
    *   *Incorrect:* `$statusTiket`, `dapatkanTiketPengguna()`, `jabatan` table.
*   **Comments in Malay:** Code comments, explanations, and commit messages can/should be written in Malay (Bahasa Melayu) to assist local maintainers.
*   **UI Text via Localization:** DO NOT hardcode user-facing text (UI) in either English or Malay directly into Blade files.
    *   Always use Laravel's localization helper: `__('ticket.submit_button')`.
    *   Define the translations in the respective `lang/en/` and `lang/ms/` directories.

## 2. Technology Stack Rules
*   **Livewire & Tailwind:** Utilize Laravel Livewire for interactive components instead of writing raw JS/jQuery or Vue/React components. Style all interfaces using Tailwind CSS utility classes.
*   **Auth & Roles:** Use Laravel Breeze (Livewire stack) for authentication scaffolding. Use `spatie/laravel-permission` for role and permission checks.

## 3. Testing is Mandatory (Wajib)
*   **No Code Without Tests:** Before finalizing any feature (e.g., submitting a ticket, changing a ticket status, assigning a role), you MUST write the corresponding tests (PHPUnit / Pest).
*   **Verify Tests:** You must run the tests locally in the sandbox using `php artisan test` and ensure they pass before issuing a `submit` command.

## 4. Execution Workflow
*   **Verify State:** Always use `read_file` or `list_files` to verify the state of the codebase before and after making changes.
*   **Database Migrations:** If you modify `DATABASE.md` or need to alter the schema, always create standard Laravel migration files (`php artisan make:migration`).
