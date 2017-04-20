<?php
namespace ContactHub\Tests;

class SessionTest extends \PHPUnit_Framework_TestCase
{
    const UUID4_REGEX = '/^[0-9A-F]{8}-[0-9A-F]{4}-[4][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i';
    const A_SESSION_ID = 'a1bc8ac2-2311-494e-bf22-1af4f64881e1';

    use ContactHubSetUpTrait;

    public function testGenerateSessionId()
    {
        $sessionId = $this->contactHub->generateSessionId();
        assertRegExp(self::UUID4_REGEX, $sessionId);
    }

    public function testGetSessions()
    {
        $sessions = $this->contactHub->getSessions(Customer::ALDO_BAGLIO);

        assertEquals($sessions['elements'][0]['id'], self::A_SESSION_ID);
        assertEquals($sessions['elements'][1]['id'], 'b7a83626-e050-40c0-b77b-bf1bdd48f808');
    }

    public function testGetSession()
    {
        $session = $this->contactHub->getSession(Customer::ALDO_BAGLIO, self::A_SESSION_ID);

        assertEquals('1779d7ef-b4fb-4012-b682-225f1c638ff4', $session['value']);
    }

    public function testAddSession()
    {
        $sessionId = $this->contactHub->generateSessionId();

        $session = $this->contactHub->addSession(Customer::ALDO_BAGLIO, $sessionId);

        assertEquals($sessionId, $session['value']);
        return $session;
    }

    /**
     * @depends testAddSession
     */
    public function testDeleteSession($session)
    {
        $this->contactHub->deleteSession(Customer::ALDO_BAGLIO, $session['id']);
    }
}