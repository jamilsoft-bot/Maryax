# Maryax ERP Blueprint

## Module Blueprint (v1)
- **Core / Admin**
  - Installer wizard, organization profile, user management, RBAC, settings, audit log.
- **CRM & Sales**
  - Leads, contacts, companies, quotes, sales orders, invoices.
- **Inventory & Procurement**
  - Products, categories, warehouses, stock movements, purchase orders.
- **Accounting & Finance**
  - Chart of accounts, journal entries, AR/AP, expenses, financial statements (baseline).
- **HR & Payroll**
  - Employees, departments, attendance, leave, payroll.
- **Projects & Tasks**
  - Projects, milestones, tasks, time tracking.
- **Documents**
  - Centralized file manager with permissions.
- **Reporting & Dashboard**
  - KPIs, CSV export, print-friendly views.

## Database Schema (Initial + Planned)
### Implemented in migrations
- **organizations**: company/tenant data.
- **users**: system users, scoped by organization.
- **roles**: RBAC roles.
- **permissions**: RBAC permissions.
- **role_user**: pivot for user roles.
- **role_permissions**: pivot for role permissions.
- **settings**: key/value settings scoped to organization.
- **audit_logs**: critical action tracking.
- **departments**: HR departments.
- **service_categories**: CRM/service classification seed data.

### Planned tables (next iterations)
- CRM: leads, contacts, companies, pipelines, stages.
- Sales: quotes, sales_orders, invoices, invoice_items, payments.
- Inventory: products, categories, warehouses, stock_levels, stock_movements.
- Accounting: chart_of_accounts, journal_entries, ledger_lines, expenses, bank_accounts.
- HR: employees, attendance, leave_requests, payrolls, payslips.
- Projects: projects, milestones, tasks, time_entries.
- Documents: folders, documents, document_permissions.

## Tenancy Strategy
- Tables are designed with `organization_id` to support multi-tenant scoping.
- Future modules must enforce organization scoping in queries and controllers.

## Implementation Notes
- Accounting logic is baseline-only in v1. Advanced costing, reconciliation, and tax automation are explicitly out of scope for the first phase.
- Any missing or unverified logic should surface a clear “Not implemented” notice in the UI.
