<?php
/**
 * Test that the skilltagicon plugin complains if the tagging plugin is missing
 *
 * @author Michael Große <grosse@cosmocode.de>
 *
 * @group Michael Große <grosse@cosmocode.de>
 * @group plugin_skilltagicon
 * @group plugins
 */

class tagging_missing_skilltagicon_test extends DokuWikiTest {
    protected $pluginsEnabled = array('skilltagicon');

    function test_tagging_missing() {
        global $ID;
        $ID = 'start';
        $request = new TestRequest();
        $input = array(
            'id' => 'start'
        );
        saveWikiText('start', '===== Some Headline =====', 'Test initialization');
        $response = $request->post($input);
        $this->assertTrue(
            strpos($response->getContent(), '===== Some Headline =====') !== false,
            'This tests the test and should always succeed.'
        );
        $this->assertTrue(
            strpos($response->getContent(), '<div class="error">The skilltagicon plugin needs the tagging plugin.</div>') !== false,
            'The error message about missing tagging plugin is missing.'
        );
    }
}
