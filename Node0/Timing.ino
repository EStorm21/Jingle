//Modified from StackOverflow
class Timer
{
public:
    Timer(void);
    void set_max_delay(unsigned long v);
    void set(void);
    boolean check(void);
private:
    unsigned long max_delay;
    unsigned long last_set;
};

Timer::Timer(void)
{
    max_delay = 3600000UL; // default 1 hour
}

void Timer::set_max_delay(unsigned long v)
{
    max_delay = v;
    set();
}

void Timer::set()
{
    last_set = millis();
}

boolean Timer::check()
{
    unsigned long now = millis();
    if (now - last_set > max_delay) {
        last_set = now;
        return true;
    }
    return false;
}



