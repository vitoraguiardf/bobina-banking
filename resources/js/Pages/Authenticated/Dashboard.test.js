import { render } from "vue";
import { assert, describe, it } from 'vitest';
import Dashboard from "./Dashboard.vue";

// todo
describe('dashboard test', () => {
  const dashboard = render(Dashboard, { Props: {}})
  it('test', () => {
    assert.equal(dashboard, dashboard, 'dashboard is dashboard')
  })
});