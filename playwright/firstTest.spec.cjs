const {test , expect} = require('@playwright/test') 

test('Login Test' , async ({page}) => {
    
    await page.goto('http://localhost:8000/')
    await page.locator('[placeholder="Email"]').fill('uolson@example.net')
    await page.locator('[placeholder="Password"]').fill('password')
    await page.locator('text=Remember Me').click()
    await page.locator('text=Sign In').click()
    await page.getByRole('link', { name: ' Create' }).click();
    await page.getByRole('link', { name: ' Videos' }).click();
    await page.getByRole('link', { name: ' Logout' }).click();
    await page.goto('http://localhost:8000/')
    await page.pause();

  
    
})